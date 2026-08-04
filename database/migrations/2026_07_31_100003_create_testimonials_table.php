<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('author_name', 255);
            $table->string('author_designation', 255)->nullable();
            $table->string('author_organization', 255)->nullable();
            $table->string('author_avatar', 500)->nullable();
            $table->text('quote');
            $table->boolean('is_enabled')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $testimonials = [
            [
                'author_name' => 'Prof. Dr. Jamil Ahmad',
                'author_designation' => 'Vice Chancellor',
                'author_organization' => 'AWKUM',
                'author_avatar' => null,
                'quote' => 'Zehanat represents a critical step forward in transforming education across Khyber Pakhtunkhwa through artificial intelligence.',
                'sort_order' => 0,
            ],
            [
                'author_name' => 'Dr. Ali Muhammad',
                'author_designation' => 'Head of AI Department',
                'author_organization' => 'AWKUM',
                'author_avatar' => null,
                'quote' => 'Our researchers and students now have a dedicated platform to collaborate on practical AI applications for education.',
                'sort_order' => 1,
            ],
            [
                'author_name' => 'Sarah Khan',
                'author_designation' => 'High School Teacher',
                'author_organization' => 'Mardan',
                'author_avatar' => null,
                'quote' => 'The resources and training provided have made integrating AI into my daily lesson planning seamless and highly effective.',
                'sort_order' => 2,
            ]
        ];

        foreach ($testimonials as &$testimonial) {
            $testimonial['is_enabled'] = true;
            $testimonial['created_at'] = $now;
            $testimonial['updated_at'] = $now;
        }

        DB::table('testimonials')->insert($testimonials);
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
