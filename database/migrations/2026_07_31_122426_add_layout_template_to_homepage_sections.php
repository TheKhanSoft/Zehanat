<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->string('layout_template', 50)->after('block_id')->nullable();
        });

        // Seed layout_template based on current block_id
        DB::table('homepage_sections')->get()->each(function ($section) {
            DB::table('homepage_sections')->where('id', $section->id)->update([
                'layout_template' => $section->block_id
            ]);
        });

        // Now make it not nullable and drop block_id's uniqueness if possible,
        // Actually, we'll keep block_id as a unique slug for the admin UI.
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->string('layout_template', 50)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->dropColumn('layout_template');
        });
    }
};
