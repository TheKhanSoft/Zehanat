<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Support\SensitivePermissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MemberImpersonationController extends Controller
{
    public function start(Request $request, Member $member): RedirectResponse
    {
        $admin = $request->user();

        abort_unless(
            $admin->hasRole('super-admin') && $admin->can(SensitivePermissions::MEMBER_IMPERSONATE),
            403,
        );
        abort_unless(
            $member->status === 'approved' && ! $member->isBanned(),
            422,
            'Only active approved members can be impersonated.',
        );

        $request->session()->put('member_impersonation', [
            'admin_id' => $admin->id,
            'member_id' => $member->id,
            'member_name' => $member->name,
            'started_at' => now()->toIso8601String(),
        ]);
        $request->session()->regenerateToken();

        Log::notice('Member impersonation started.', [
            'admin_id' => $admin->id,
            'member_id' => $member->id,
            'ip' => $request->ip(),
        ]);

        return redirect()
            ->route('member.portal')
            ->with('success', "You are now previewing the portal as {$member->name}.");
    }

    public function show(Request $request): View
    {
        $impersonation = $request->session()->get('member_impersonation');

        abort_unless(
            is_array($impersonation)
                && (int) ($impersonation['admin_id'] ?? 0) === (int) $request->user()->id
                && $request->user()->hasRole('super-admin'),
            403,
        );

        $member = Member::find($impersonation['member_id'] ?? null);

        if (! $member || $member->status !== 'approved' || $member->isBanned()) {
            $request->session()->forget('member_impersonation');
            abort(403, 'This member is no longer available for impersonation.');
        }

        return view('member.portal', compact('member'));
    }

    public function stop(Request $request): RedirectResponse
    {
        $impersonation = $request->session()->get('member_impersonation');

        abort_unless(
            is_array($impersonation)
                && (int) ($impersonation['admin_id'] ?? 0) === (int) $request->user()->id,
            403,
        );

        Log::notice('Member impersonation stopped.', [
            'admin_id' => $request->user()->id,
            'member_id' => $impersonation['member_id'] ?? null,
            'ip' => $request->ip(),
        ]);

        $request->session()->forget('member_impersonation');
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member impersonation ended. You are back in the admin panel.');
    }
}
