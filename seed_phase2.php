<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

$now = now();
$newSettings = [
    // General
    ['key' => 'site_logo_dark', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Site Logo (Dark Text / Light Background)', 'description' => 'Used in light navbars and areas with light backgrounds.', 'options' => null, 'sort_order' => 7],
    ['key' => 'site_logo_light', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Site Logo (Light Text / Dark Background)', 'description' => 'Used in dark navbars and footers.', 'options' => null, 'sort_order' => 8],
    ['key' => 'site_favicon', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Favicon', 'description' => 'Must be a square image (e.g. 512x512).', 'options' => null, 'sort_order' => 9],
    
    // SEO
    ['key' => 'seo_og_image_upload', 'value' => '', 'group' => 'seo', 'type' => 'image', 'label' => 'Default Open Graph Image', 'description' => 'Image shown when sharing the site on social media.', 'options' => null, 'sort_order' => 6],
    
    // Appearance
    ['key' => 'theme_footer_style', 'value' => 'dark', 'group' => 'appearance', 'type' => 'select', 'label' => 'Footer Style', 'description' => null, 'options' => json_encode(["dark" => "Dark Background", "primary" => "Primary Color Background", "light" => "Light Background"]), 'sort_order' => 11],
    ['key' => 'theme_card_shadow', 'value' => 'shadow-md', 'group' => 'appearance', 'type' => 'select', 'label' => 'Card Shadows', 'description' => 'Global shadow depth for all cards.', 'options' => json_encode(["none" => "Flat (No Shadow, Border only)", "shadow-sm" => "Soft (Small)", "shadow-md" => "Medium", "shadow-xl" => "Hard (Large)"]), 'sort_order' => 12],
    ['key' => 'theme_custom_css', 'value' => '', 'group' => 'appearance', 'type' => 'textarea_code', 'label' => 'Custom CSS', 'description' => 'Inject raw CSS into the public site layout. Use carefully.', 'options' => null, 'sort_order' => 13],
];

foreach ($newSettings as $s) {
    if (!Setting::where('key', $s['key'])->exists()) {
        $s['created_at'] = $now;
        $s['updated_at'] = $now;
        DB::table('settings')->insert($s);
        echo "Inserted: " . $s['key'] . "\n";
    } else {
        echo "Exists: " . $s['key'] . "\n";
    }
}
Setting::flushCache();
echo "Done.\n";
