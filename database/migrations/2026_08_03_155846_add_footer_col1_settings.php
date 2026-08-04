<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            [
                'key' => 'footer_logo',
                'value' => '/images/brand/favicon.svg',
                'group' => 'footer',
                'type' => 'image',
                'label' => 'Footer Logo Override',
                'description' => 'Leave empty to automatically use the Site Logo (Dark/Light).',
                'sort_order' => 1,
            ],
            [
                'key' => 'footer_description',
                'value' => "Zehanat is Pakistan's premier Artificial Intelligence Society, dedicated to advancing AI education, research, and ethical implementation across the nation's academic institutions.",
                'group' => 'footer',
                'type' => 'textarea',
                'label' => 'Footer Description',
                'description' => 'Short text displayed under the logo.',
                'sort_order' => 2,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }

    public function down(): void
    {
        Setting::whereIn('key', [
            'footer_logo',
            'footer_description',
        ])->delete();
    }
};
