<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\SensitivePermissions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserImpersonationController extends Controller
{
    public function start(Request $request, User $user): RedirectResponse
    {
        $superAdmin = $request->user();

        abort_unless(
            $superAdmin->hasRole('super-admin')
                && $superAdmin->can(SensitivePermissions::USER_IMPERSONATE),
            403,
        );
        abort_if($request->session()->has('user_impersonation'), 422, 'An impersonation session is already active.');
        abort_if($user->is($superAdmin), 422, 'You cannot impersonate your own account.');
        abort_if($user->hasRole('super-admin'), 422, 'Super-admin accounts cannot be impersonated.');
        abort_unless($user->can('view dashboard'), 422, 'Only users with admin dashboard access can be impersonated.');

        $request->session()->put('user_impersonation', [
            'impersonator_id' => $superAdmin->id,
            'target_id' => $user->id,
            'target_name' => $user->name,
            'started_at' => now()->toIso8601String(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        Log::notice('User impersonation started.', [
            'impersonator_id' => $superAdmin->id,
            'target_id' => $user->id,
            'ip' => $request->ip(),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', "You are now logged in as {$user->name}.");
    }

    public function stop(Request $request): RedirectResponse
    {
        $impersonation = $request->session()->get('user_impersonation');

        abort_unless(
            is_array($impersonation)
                && (int) ($impersonation['target_id'] ?? 0) === (int) $request->user()->id,
            403,
        );

        $superAdmin = User::find($impersonation['impersonator_id'] ?? null);

        if (! $superAdmin
            || ! $superAdmin->hasRole('super-admin')
            || ! $superAdmin->can(SensitivePermissions::USER_IMPERSONATE)) {
            $request->session()->forget('user_impersonation');
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'The original super-admin account is no longer available.');
        }

        $targetId = $request->user()->id;
        Auth::login($superAdmin);
        $request->session()->regenerate();
        $request->session()->forget('user_impersonation');

        Log::notice('User impersonation stopped.', [
            'impersonator_id' => $superAdmin->id,
            'target_id' => $targetId,
            'ip' => $request->ip(),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User impersonation ended. You are back in your super-admin account.');
    }
}
