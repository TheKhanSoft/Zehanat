<?php

namespace App\Http\Controllers;

use App\Enums\EmailTemplateKey;
use App\Mail\WelcomeMember;
use App\Models\Member;
use App\Services\EmailTemplateRenderer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MembershipController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $email = $request->input('email');
        if (is_string($email)) {
            $request->merge(['email' => Str::lower(trim($email))]);
        }

        $phone = $request->input('phone');

        if (is_string($phone)) {
            $phone = trim($phone);
            $phone = $phone === '' ? null : preg_replace('/[\s().-]+/', '', $phone);
            $request->merge(['phone' => $phone]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $exists = Member::query()
                        ->whereRaw('LOWER(email) = ?', [Str::lower((string) $value)])
                        ->exists();

                    if ($exists) {
                        $fail('A membership application already exists for this email address.');
                    }
                },
            ],
            'phone' => ['nullable', 'string', 'regex:/^\+?[0-9]{7,15}$/'],
            'category' => 'required|in:individual,institution,industry,student',
            'institution' => [
                Rule::requiredIf(fn (): bool => in_array(
                    $request->input('category'),
                    ['institution', 'industry', 'student'],
                    true,
                )),
                'nullable',
                'string',
                'max:255',
            ],
            'message' => 'nullable|string|max:2000',
        ], [
            'phone.regex' => 'Enter a valid phone number with 7 to 15 digits. A leading + is allowed.',
            'category.required' => 'Choose the membership category that best describes you.',
            'category.in' => 'Choose one of the available membership categories.',
            'institution.required' => 'Institution/Organization Name is required for institution, industry, and student memberships.',
        ]);

        $member = Member::create($validated);

        // Send welcome email
        if (app(EmailTemplateRenderer::class)->isActive(EmailTemplateKey::MembershipRegistration)) {
            Mail::to($member->email)->send(new WelcomeMember($member));
        }

        return redirect()->back()->with('success', 'Your membership application has been submitted successfully! A welcome email has been sent to your address.');
    }
}
