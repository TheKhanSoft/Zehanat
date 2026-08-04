<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

$now = now();
$newSettings = [
    ['key' => 'theme_font_heading', 'value' => 'Montserrat', 'group' => 'appearance', 'type' => 'select', 'label' => 'Heading Font', 'description' => null, 'options' => json_encode(["Montserrat", "Inter", "Roboto", "Playfair Display"]), 'sort_order' => 6],
    ['key' => 'theme_font_body', 'value' => 'Nunito Sans', 'group' => 'appearance', 'type' => 'select', 'label' => 'Body Font', 'description' => null, 'options' => json_encode(["Nunito Sans", "Open Sans", "Lato", "Inter"]), 'sort_order' => 7],
    ['key' => 'theme_border_radius', 'value' => '0.5rem', 'group' => 'appearance', 'type' => 'select', 'label' => 'Global Border Radius', 'description' => 'Affects buttons, cards, and UI elements.', 'options' => json_encode(["0px" => "Sharp (0px)", "0.5rem" => "Rounded (sm)", "1rem" => "Rounded (lg)", "9999px" => "Pill (Full)"]), 'sort_order' => 8],
    ['key' => 'theme_button_style', 'value' => 'solid', 'group' => 'appearance', 'type' => 'select', 'label' => 'Button Style', 'description' => null, 'options' => json_encode(["solid" => "Solid Colors", "gradient" => "Gradient Colors"]), 'sort_order' => 9],
    ['key' => 'theme_navbar_style', 'value' => 'sticky_light', 'group' => 'appearance', 'type' => 'select', 'label' => 'Navbar Style', 'description' => null, 'options' => json_encode(["sticky_light" => "Sticky (Light)", "transparent" => "Transparent to Solid", "dark" => "Dark Mode"]), 'sort_order' => 10],
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
