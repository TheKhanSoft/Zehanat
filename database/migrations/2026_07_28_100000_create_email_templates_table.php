<?php

use App\Support\EmailTemplateDefaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->string('category')->index();
            $table->text('description')->nullable();
            $table->string('subject');
            $table->string('preheader')->nullable();
            $table->longText('body_html');
            $table->longText('body_text')->nullable();
            $table->json('variables')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('is_system')->default(false)->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        $now = now();

        foreach (EmailTemplateDefaults::all() as $key => $definition) {
            DB::table('email_templates')->insert([
                'key' => $key,
                'name' => $definition['name'],
                'category' => $definition['category'],
                'description' => $definition['description'],
                'subject' => $definition['subject'],
                'preheader' => $definition['preheader'],
                'body_html' => $definition['body_html'],
                'body_text' => $definition['body_text'],
                'variables' => json_encode($definition['variables'], JSON_THROW_ON_ERROR),
                'is_active' => $definition['is_active'],
                'is_system' => true,
                'sort_order' => $definition['sort_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
