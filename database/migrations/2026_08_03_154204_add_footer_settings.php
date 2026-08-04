<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            [
                'key' => 'footer_bg_image',
                'value' => '',
                'group' => 'footer',
                'type' => 'bg_image_group',
                'label' => 'Footer Background',
                'description' => 'Optional background image and overlay styling for the footer.',
                'options' => null,
                'sort_order' => 1
            ],
            [
                'key' => 'footer_bg_overlay_color',
                'value' => '',
                'group' => 'footer',
                'type' => 'hidden',
                'label' => 'Overlay Color',
                'description' => null,
                'options' => null,
                'sort_order' => 2
            ],
            [
                'key' => 'footer_bg_overlay_opacity',
                'value' => '90',
                'group' => 'footer',
                'type' => 'hidden',
                'label' => 'Overlay Opacity',
                'description' => null,
                'options' => null,
                'sort_order' => 3
            ],
            [
                'key' => 'footer_col2_heading',
                'value' => 'Quick Links',
                'group' => 'footer',
                'type' => 'text',
                'label' => 'Column 2 Heading',
                'description' => 'Heading for the second column.',
                'options' => null,
                'sort_order' => 4
            ],
            [
                'key' => 'footer_col2_links',
                'value' => json_encode([
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'About Society', 'url' => '/about'],
                    ['label' => 'Our Six Pillars', 'url' => '/pillars'],
                    ['label' => 'AI Programs', 'url' => '/programs'],
                    ['label' => 'Become a Member', 'url' => '/membership']
                ]),
                'group' => 'footer',
                'type' => 'repeater_links',
                'label' => 'Column 2 Links',
                'description' => 'Manage the links shown in the second column.',
                'options' => null,
                'sort_order' => 5
            ],
            [
                'key' => 'footer_col3_heading',
                'value' => 'Key Programs',
                'group' => 'footer',
                'type' => 'text',
                'label' => 'Column 3 Heading',
                'description' => 'Heading for the third column.',
                'options' => null,
                'sort_order' => 6
            ],
            [
                'key' => 'footer_col3_links',
                'value' => json_encode([
                    ['label' => 'AI Lab Setups', 'url' => '/programs#labs'],
                    ['label' => 'Educator Training', 'url' => '/programs#training'],
                    ['label' => 'Student Workshops', 'url' => '/programs#workshops'],
                    ['label' => 'Research Grants', 'url' => '/programs#grants'],
                    ['label' => 'Policy Frameworks', 'url' => '/programs#policy']
                ]),
                'group' => 'footer',
                'type' => 'repeater_links',
                'label' => 'Column 3 Links',
                'description' => 'Manage the links shown in the third column.',
                'options' => null,
                'sort_order' => 7
            ],
            [
                'key' => 'footer_col4_heading',
                'value' => 'Contact Us',
                'group' => 'footer',
                'type' => 'text',
                'label' => 'Column 4 Heading',
                'description' => 'Heading for the fourth column (Contact Info).',
                'options' => null,
                'sort_order' => 8
            ],
            [
                'key' => 'footer_copyright_text',
                'value' => 'Copyright &copy; 2026 Zehanat. All rights reserved.',
                'group' => 'footer',
                'type' => 'text',
                'label' => 'Copyright Text',
                'description' => 'Text displayed at the very bottom of the footer.',
                'options' => null,
                'sort_order' => 9
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
        Setting::flushCache();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Setting::where('group', 'footer')->delete();
        Setting::flushCache();
    }
};
