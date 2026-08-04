<?php
require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::first();
auth()->login($user);

$component = new App\Livewire\Admin\HomepageManager();
$component->editingSectionId = \App\Models\HomepageSection::where("layout_template", "stats")->first()?->id;
if (!$component->editingSectionId) die("No stats block found");
$component->sectionContent = ["items" => []];

try {
    $component->addArrayItem("items");
    echo json_encode($component->sectionContent, JSON_PRETTY_PRINT);
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString();
}

