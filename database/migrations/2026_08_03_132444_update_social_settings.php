<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete old social settings
        DB::table('settings')->whereIn('key', [
            'social_facebook',
            'social_twitter',
            'social_linkedin',
            'social_youtube'
        ])->delete();

        // Insert new social networks JSON setting
        $defaultNetworks = [
            ['platform' => 'facebook', 'url' => '#'],
            ['platform' => 'twitter', 'url' => '#'],
            ['platform' => 'linkedin', 'url' => '#']
        ];

        DB::table('settings')->insert([
            'key' => 'social_networks',
            'value' => json_encode($defaultNetworks),
            'group' => 'contact',
            'type' => 'repeater_social',
            'label' => 'Social Networks',
            'description' => 'Add your active social network profiles.',
            'options' => null,
            'sort_order' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('key', 'social_networks')->delete();

        DB::table('settings')->insert([
            ['key' => 'social_facebook', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'Facebook URL', 'description' => null, 'options' => null, 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_twitter', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'Twitter/X URL', 'description' => null, 'options' => null, 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_linkedin', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'LinkedIn URL', 'description' => null, 'options' => null, 'sort_order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'contact', 'type' => 'url', 'label' => 'YouTube URL', 'description' => null, 'options' => null, 'sort_order' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
};
