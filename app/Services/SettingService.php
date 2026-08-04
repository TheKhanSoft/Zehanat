<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public function get(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }

    public function set(string $key, mixed $value): void
    {
        Setting::set($key, $value);
    }

    public function setMany(array $settings): void
    {
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $this->flush();
    }

    public function getGroup(string $group): array
    {
        return Setting::getGroup($group);
    }

    public function flush(): void
    {
        Setting::flushCache();
    }
}
