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
        // Update google map sort order to appear above social networks (which is 5)
        DB::table('settings')->where('key', 'google_map_embed')->update(['sort_order' => 4]);

        // Update default logos/images
        DB::table('settings')->where('key', 'site_logo_dark')->update(['value' => '/images/brand/zehanat_logo_horizontal.svg']);
        DB::table('settings')->where('key', 'site_logo_light')->update(['value' => '/images/brand/zehanat_logo_horizontal_dark.svg']);
        DB::table('settings')->where('key', 'site_favicon')->update(['value' => '/images/brand/favicon.svg']);
        DB::table('settings')->where('key', 'seo_og_image_upload')->update(['value' => '/images/brand/og-image-1200x630.jpg']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('key', 'google_map_embed')->update(['sort_order' => 10]);
        DB::table('settings')->where('key', 'site_logo_dark')->update(['value' => '']);
        DB::table('settings')->where('key', 'site_logo_light')->update(['value' => '']);
        DB::table('settings')->where('key', 'site_favicon')->update(['value' => '']);
        DB::table('settings')->where('key', 'seo_og_image_upload')->update(['value' => '']);
    }
};
