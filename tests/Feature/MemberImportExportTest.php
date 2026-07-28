<?php

namespace Tests\Feature;

use App\Livewire\Admin\MemberManager;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MemberImportExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_and_export_controls_follow_independent_permissions(): void
    {
        $importer = $this->userWithPermissions('member-importer', ['view members', 'import members']);
        $exporter = $this->userWithPermissions('member-exporter', ['view members', 'export members']);

        Livewire::actingAs($importer)
            ->test(MemberManager::class)
            ->assertSee('Import CSV')
            ->assertDontSee('Export CSV')
            ->call('exportMembers')
            ->assertForbidden();

        Livewire::actingAs($exporter)
            ->test(MemberManager::class)
            ->assertSee('Export CSV')
            ->assertDontSee('Import CSV')
            ->call('openImportModal')
            ->assertForbidden();
    }

    public function test_csv_import_applies_safe_defaults_and_member_access_rules(): void
    {
        $importer = $this->userWithPermissions('member-importer', ['view members', 'import members']);
        $file = $this->csvFile([
            ['Ali Member', 'ALI@example.com', '+92 (300) 123-4567', 'Individual', '', '', '', '', '2025-01-15'],
            ['Banned Member', 'banned-import@example.com', '03001234567', 'Institution', 'Zehanat Academy', 'Approved', 'Banned', 'Repeated policy violations', '2025-02-10'],
        ]);

        Livewire::actingAs($importer)
            ->test(MemberManager::class)
            ->call('openImportModal')
            ->assertSet('showImportModal', true)
            ->set('importFile', $file)
            ->call('importMembers')
            ->assertHasNoErrors()
            ->assertSet('importSummary.imported', 2)
            ->assertSet('importSummary.skipped', 0)
            ->assertSet('importSummary.total', 2)
            ->assertSet('importFile', null)
            ->assertDispatched('notify');

        $active = Member::where('email', 'ali@example.com')->firstOrFail();
        $this->assertSame('+923001234567', $active->phone);
        $this->assertSame('individual', $active->category);
        $this->assertSame('pending', $active->status);
        $this->assertNull($active->banned_at);
        $this->assertNull($active->ban_reason);
        $this->assertSame('2025-01-15', $active->created_at->toDateString());

        $banned = Member::where('email', 'banned-import@example.com')->firstOrFail();
        $this->assertSame('approved', $banned->status);
        $this->assertTrue($banned->isBanned());
        $this->assertSame('Repeated policy violations', $banned->ban_reason);
        $this->assertSame('2025-02-10', $banned->created_at->toDateString());
    }

    public function test_csv_import_skips_invalid_and_existing_rows_without_overwriting_them(): void
    {
        $importer = $this->userWithPermissions('member-importer', ['view members', 'import members']);
        $existing = Member::create([
            'name' => 'Existing Member',
            'email' => 'existing@example.com',
            'category' => 'student',
            'status' => 'approved',
        ]);
        $file = $this->csvFile([
            ['Overwrite Attempt', 'existing@example.com', '03001234567', 'student', '', 'approved', 'active', '', '2025-01-01'],
            ['Invalid Category', 'invalid-category@example.com', '03001234567', 'volunteer', '', '', '', '', '2025-01-01'],
            ['Invalid Ban', 'invalid-ban@example.com', '03001234567', 'student', '', '', 'banned', '', '2025-01-01'],
            ['Valid Member', 'valid-import@example.com', '03001234567', 'student', 'Zehanat University', 'approved', 'active', '', '2025-01-01'],
        ]);

        Livewire::actingAs($importer)
            ->test(MemberManager::class)
            ->set('importFile', $file)
            ->call('importMembers')
            ->assertHasNoErrors()
            ->assertSet('importSummary.imported', 1)
            ->assertSet('importSummary.skipped', 3)
            ->assertSet('importSummary.total', 4)
            ->assertSee('Rows needing attention')
            ->assertSee('A member with this email already exists.')
            ->assertSee('Category must be individual, institution, industry, or student.')
            ->assertSee('Only approved members can have Banned access.');

        $this->assertSame('Existing Member', $existing->fresh()->name);
        $this->assertDatabaseHas('members', ['email' => 'valid-import@example.com']);
        $this->assertDatabaseMissing('members', ['email' => 'invalid-category@example.com']);
        $this->assertDatabaseCount('members', 2);
    }

    public function test_csv_import_requires_an_organization_for_non_individual_members(): void
    {
        $importer = $this->userWithPermissions('member-importer', ['view members', 'import members']);
        $file = $this->csvFile([
            ['Missing Institution', 'missing-institution@example.com', '03001234567', 'institution', '', '', '', '', '2025-01-01'],
            ['Missing Industry', 'missing-industry@example.com', '03001234567', 'industry', '', '', '', '', '2025-01-01'],
            ['Missing Student School', 'missing-student@example.com', '03001234567', 'student', '', '', '', '', '2025-01-01'],
            ['Independent', 'independent-import@example.com', '03001234567', 'individual', '', '', '', '', '2025-01-01'],
        ]);

        Livewire::actingAs($importer)
            ->test(MemberManager::class)
            ->set('importFile', $file)
            ->call('importMembers')
            ->assertHasNoErrors()
            ->assertSet('importSummary.imported', 1)
            ->assertSet('importSummary.skipped', 3)
            ->assertSee('Institution is required for institution, industry, and student members.');

        $this->assertDatabaseHas('members', ['email' => 'independent-import@example.com']);
        $this->assertDatabaseMissing('members', ['email' => 'missing-institution@example.com']);
        $this->assertDatabaseMissing('members', ['email' => 'missing-industry@example.com']);
        $this->assertDatabaseMissing('members', ['email' => 'missing-student@example.com']);
    }

    public function test_csv_import_requires_the_documented_headers(): void
    {
        $importer = $this->userWithPermissions('member-importer', ['view members', 'import members']);
        $file = UploadedFile::fake()->createWithContent(
            'members.csv',
            "Name,Email,Category\nMissing Headers,missing@example.com,student\n",
        );

        Livewire::actingAs($importer)
            ->test(MemberManager::class)
            ->set('importFile', $file)
            ->call('importMembers')
            ->assertHasErrors('importFile')
            ->assertSee('Missing required CSV headers')
            ->assertSet('importSummary', null);

        $this->assertDatabaseCount('members', 0);
    }

    public function test_authorized_user_can_download_import_template_and_filtered_export(): void
    {
        $operator = $this->userWithPermissions('member-data-manager', [
            'view members',
            'import members',
            'export members',
        ]);
        Member::create([
            'name' => 'Exported Student',
            'email' => 'exported-student@example.com',
            'category' => 'student',
            'status' => 'approved',
        ]);
        Member::create([
            'name' => 'Filtered Individual',
            'email' => 'filtered-individual@example.com',
            'category' => 'individual',
            'status' => 'pending',
        ]);

        Livewire::actingAs($operator)
            ->test(MemberManager::class)
            ->call('downloadImportTemplate')
            ->assertFileDownloaded('members-import-template.csv');

        Livewire::actingAs($operator)
            ->test(MemberManager::class)
            ->set('categoryFilter', 'student')
            ->call('exportMembers')
            ->assertFileDownloaded('zehanat-members-'.now()->format('Y-m-d').'.csv');
    }

    private function userWithPermissions(string $roleName, array $permissions): User
    {
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        $role->syncPermissions($permissions);
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    private function csvFile(array $rows): UploadedFile
    {
        $stream = fopen('php://temp', 'w+b');
        fputcsv($stream, ['Name', 'Email', 'Phone', 'Category', 'Institution', 'Status', 'Access', 'Ban Reason', 'Joined']);

        foreach ($rows as $row) {
            fputcsv($stream, $row);
        }

        rewind($stream);
        $content = stream_get_contents($stream);
        fclose($stream);

        return UploadedFile::fake()->createWithContent('members.csv', $content);
    }
}
