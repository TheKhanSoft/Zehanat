<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

final class ErrorPageDestination
{
    /**
     * @return array{label: string, url: string, context: string}
     */
    public static function resolve(Request $request): array
    {
        $publicHome = self::route('home', '/');

        try {
            $user = $request->user();

            if ($user && $request->hasSession()) {
                $impersonation = $request->session()->get('member_impersonation');

                if (
                    is_array($impersonation)
                    && (int) ($impersonation['admin_id'] ?? 0) === (int) $user->getAuthIdentifier()
                    && isset($impersonation['member_id'])
                ) {
                    return [
                        'label' => 'Return to member portal',
                        'url' => self::route('member.portal', '/member/portal'),
                        'context' => 'member',
                    ];
                }
            }

            if ($user instanceof User) {
                if ($user->can('view dashboard') && $user->roles()->exists()) {
                    return [
                        'label' => 'Return to admin dashboard',
                        'url' => self::route('admin.dashboard', '/admin'),
                        'context' => 'admin',
                    ];
                }

                return [
                    'label' => 'Return to your dashboard',
                    'url' => self::route('dashboard', '/dashboard'),
                    'context' => 'user',
                ];
            }

        } catch (Throwable) {
            // Error pages must remain renderable if auth, sessions, or the database are unavailable.
        }

        return [
            'label' => 'Return to public home',
            'url' => $publicHome,
            'context' => 'guest',
        ];
    }

    private static function route(string $name, string $fallback): string
    {
        try {
            return route($name);
        } catch (Throwable) {
            return url($fallback);
        }
    }
}
