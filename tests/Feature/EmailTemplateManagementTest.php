<?php

namespace Tests\Feature;

use App\Enums\EmailTemplateKey;
use App\Livewire\Admin\EmailTemplateManager;
use App\Mail\ManagedTemplateMail;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Services\EmailTemplateRenderer;
use App\Support\AdminPermissions;
use App\Support\EmailTemplateDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EmailTemplateManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_templates_and_management_permissions_are_created_by_migrations(): void
    {
        $this->assertCount(16, EmailTemplateDefaults::all());
        $this->assertSame(16, EmailTemplate::count());

        foreach (EmailTemplateKey::cases() as $key) {
            $this->assertDatabaseHas('email_templates', [
                'key' => $key->value,
                'is_system' => true,
            ]);
        }

        $admin = Role::findByName('admin');
        foreach ([
            'view email templates',
            'create email templates',
            'edit email templates',
            'delete email templates',
            AdminPermissions::EMAIL_TEMPLATE_SEND_TEST,
        ] as $permission) {
            $this->assertTrue($admin->hasPermissionTo($permission));
        }
    }

    public function test_renderer_safely_replaces_variables_and_builds_html_and_text_versions(): void
    {
        $template = EmailTemplate::where('key', EmailTemplateKey::MembershipApproved->value)->firstOrFail();
        $template->update([
            'subject' => 'Approved for {{ recipient_name }}',
            'body_html' => '<h1>Hello {{ recipient_name }}</h1><p>{{ institution }}</p>',
        ]);

        $rendered = app(EmailTemplateRenderer::class)->render($template->key, [
            'recipient_name' => '<script>alert(1)</script>',
            'institution' => 'Zehanat & Partners',
        ]);

        $this->assertSame('Approved for alert(1)', $rendered->subject);
        $this->assertStringNotContainsString('<script>alert(1)</script>', $rendered->html);
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $rendered->html);
        $this->assertStringContainsString('Zehanat &amp; Partners', $rendered->html);
        $this->assertStringContainsString('Hello <script>alert(1)</script>', $rendered->text);
    }

    public function test_authorized_admin_can_edit_preview_test_and_restore_a_system_template(): void
    {
        Mail::fake();
        $admin = $this->adminWithPermissions([
            'view email templates',
            'edit email templates',
            AdminPermissions::EMAIL_TEMPLATE_SEND_TEST,
        ]);
        $template = EmailTemplate::where('key', EmailTemplateKey::MembershipApproved->value)->firstOrFail();
        $originalSubject = $template->subject;

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->call('edit', $template->id)
            ->assertSet('key', EmailTemplateKey::MembershipApproved->value)
            ->set('subject', 'A better approval subject')
            ->call('save')
            ->assertHasNoErrors()
            ->call('preview', $template->id)
            ->call('openTestModal', $template->id)
            ->assertSet('showTestModal', true)
            ->set('testRecipients', [
                ['name' => 'Ayesha Khan', 'email' => 'ayesha@example.com'],
                ['name' => '', 'email' => 'preview@example.com'],
            ])
            ->call('sendTestEmails')
            ->assertHasNoErrors()
            ->assertSet('showTestModal', false)
            ->call('resetToDefault', $template->id);

        $template->refresh();
        $this->assertSame(EmailTemplateKey::MembershipApproved->value, $template->key);
        $this->assertSame($originalSubject, $template->subject);
        Mail::assertSentCount(2);
        Mail::assertSent(
            ManagedTemplateMail::class,
            fn (ManagedTemplateMail $mail) => $mail->hasTo('ayesha@example.com')
                && $mail->variables['recipient_name'] === 'Ayesha Khan',
        );
        Mail::assertSent(
            ManagedTemplateMail::class,
            fn (ManagedTemplateMail $mail) => $mail->hasTo('preview@example.com')
                && $mail->variables['recipient_name'] === 'Test recipient',
        );
    }

    public function test_test_email_recipients_must_be_valid_and_unique(): void
    {
        Mail::fake();
        $admin = $this->adminWithPermissions([
            'view email templates',
            AdminPermissions::EMAIL_TEMPLATE_SEND_TEST,
        ]);
        $template = EmailTemplate::firstOrFail();

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->call('openTestModal', $template->id)
            ->set('testRecipients', [
                ['name' => 'First', 'email' => 'same@example.com'],
                ['name' => 'Second', 'email' => 'SAME@example.com'],
            ])
            ->call('sendTestEmails')
            ->assertHasErrors(['testRecipients.1.email' => 'distinct']);

        Mail::assertNothingSent();
    }

    public function test_send_test_action_is_hidden_and_forbidden_without_its_permission(): void
    {
        $admin = $this->adminWithPermissions(['view email templates']);
        $template = EmailTemplate::firstOrFail();

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->assertDontSee('Send test email')
            ->call('openTestModal', $template->id)
            ->assertForbidden();
    }

    public function test_custom_templates_can_be_created_and_deleted_but_system_templates_cannot_be_deleted(): void
    {
        $admin = $this->adminWithPermissions([
            'view email templates',
            'create email templates',
            'delete email templates',
        ]);

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->call('create')
            ->set('key', 'custom.weekly_digest')
            ->set('name', 'Weekly digest')
            ->set('category', 'News')
            ->set('subject', 'Your weekly digest')
            ->set('bodyHtml', '<h1>Hello {{ recipient_name }}</h1>')
            ->call('save')
            ->assertHasNoErrors();

        $custom = EmailTemplate::where('key', 'custom.weekly_digest')->firstOrFail();

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->call('deleteTemplate', $custom->id);

        $this->assertDatabaseMissing('email_templates', ['id' => $custom->id]);

        Livewire::actingAs($admin)
            ->test(EmailTemplateManager::class)
            ->call('deleteTemplate', EmailTemplate::where('is_system', true)->value('id'))
            ->assertStatus(422);
    }

    public function test_user_without_view_permission_cannot_access_email_templates(): void
    {
        $user = $this->adminWithPermissions([]);

        Livewire::actingAs($user)
            ->test(EmailTemplateManager::class)
            ->assertForbidden();
    }

    private function adminWithPermissions(array $permissions): User
    {
        $role = Role::firstOrCreate(['name' => 'template-test-admin', 'guard_name' => 'web']);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        $role->syncPermissions($permissions);

        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }
}
