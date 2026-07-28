<?php

namespace Tests\Feature;

use App\Mail\WelcomeMember;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MembershipRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_membership_form_uses_numeric_phone_controls_and_category_cards(): void
    {
        $this->get(route('membership'))
            ->assertOk()
            ->assertSee('Membership Category')
            ->assertSee('Educators, researchers and professionals')
            ->assertSee('Schools, colleges and universities')
            ->assertSeeHtml('data-phone-input')
            ->assertSeeHtml('pattern="\+?[0-9]{7,15}"')
            ->assertSeeHtml('type="radio"')
            ->assertSeeHtml('data-category-select="institution"')
            ->assertSeeHtml('data-organization-input')
            ->assertSeeHtml('data-organization-requirement');
    }

    public function test_formatted_phone_number_is_normalized_before_storage(): void
    {
        Mail::fake();

        $this->post(route('membership.store'), [
            'name' => 'Ayesha Khan',
            'email' => 'ayesha@example.com',
            'phone' => '+92 (300) 123-4567',
            'category' => 'individual',
            'institution' => 'Zehanat',
            'message' => 'I would like to contribute.',
        ])
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $member = Member::where('email', 'ayesha@example.com')->firstOrFail();

        $this->assertSame('+923001234567', $member->phone);
        Mail::assertSent(WelcomeMember::class, fn (WelcomeMember $mail) => $mail->member->is($member));
    }

    public function test_phone_number_rejects_letters_and_invalid_lengths(): void
    {
        Mail::fake();

        foreach (['0300CALLME', '12345', '+1234567890123456', '0300#1234567'] as $index => $phone) {
            $this->from(route('membership'))
                ->post(route('membership.store'), [
                    'name' => 'Invalid Phone',
                    'email' => "invalid-{$index}@example.com",
                    'phone' => $phone,
                    'category' => 'student',
                ])
                ->assertRedirect(route('membership'))
                ->assertSessionHasErrors('phone');
        }

        $this->assertDatabaseCount('members', 0);
        Mail::assertNothingSent();
    }

    public function test_member_cannot_register_twice_with_the_same_email_address(): void
    {
        Mail::fake();
        Member::create([
            'name' => 'Existing Member',
            'email' => 'existing.member@example.com',
            'category' => 'individual',
            'status' => 'pending',
        ]);

        $this->from(route('membership'))
            ->post(route('membership.store'), [
                'name' => 'Duplicate Applicant',
                'email' => ' Existing.Member@Example.com ',
                'phone' => '03001234567',
                'category' => 'student',
            ])
            ->assertRedirect(route('membership'))
            ->assertSessionHasErrors([
                'email' => 'A membership application already exists for this email address.',
            ]);

        $this->assertDatabaseCount('members', 1);
        Mail::assertNothingSent();
    }

    public function test_category_must_be_one_of_the_presented_options(): void
    {
        Mail::fake();

        $this->from(route('membership'))
            ->post(route('membership.store'), [
                'name' => 'Invalid Category',
                'email' => 'invalid-category@example.com',
                'phone' => '03001234567',
                'category' => 'unknown',
            ])
            ->assertRedirect(route('membership'))
            ->assertSessionHasErrors('category');

        $this->assertDatabaseCount('members', 0);
        Mail::assertNothingSent();
    }

    public function test_organization_is_required_for_every_non_individual_membership_category(): void
    {
        Mail::fake();

        foreach (['institution', 'industry', 'student'] as $category) {
            $this->from(route('membership'))
                ->post(route('membership.store'), [
                    'name' => 'Missing Organization',
                    'email' => "missing-{$category}@example.com",
                    'phone' => '03001234567',
                    'category' => $category,
                    'institution' => '   ',
                ])
                ->assertRedirect(route('membership'))
                ->assertSessionHasErrors([
                    'institution' => 'Institution/Organization Name is required for institution, industry, and student memberships.',
                ]);
        }

        $this->assertDatabaseCount('members', 0);
        Mail::assertNothingSent();
    }

    public function test_individual_membership_can_be_submitted_without_an_organization(): void
    {
        Mail::fake();

        $this->post(route('membership.store'), [
            'name' => 'Independent Member',
            'email' => 'independent@example.com',
            'phone' => '03001234567',
            'category' => 'individual',
            'institution' => '',
        ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('members', [
            'email' => 'independent@example.com',
            'category' => 'individual',
            'institution' => null,
        ]);
    }
}
