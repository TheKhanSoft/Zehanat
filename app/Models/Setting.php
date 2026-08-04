<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable([
    'key',
    'value',
    'group',
    'type',
    'label',
    'description',
    'options',
    'sort_order',
])]
class Setting extends Model
{
    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = self::getAllCached();

        return array_key_exists($key, $settings) ? $settings[$key] : $default;
    }

    public static function set(string $key, mixed $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        self::flushCache();
    }

    public static function getGroup(string $group): array
    {
        return self::where('group', $group)
            ->orderBy('sort_order')
            ->pluck('value', 'key')
            ->toArray();
    }

    public static function getAllCached(): array
    {
        return Cache::rememberForever('app_settings', function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('app_settings');
    }
}
