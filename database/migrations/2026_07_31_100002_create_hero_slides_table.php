<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('tag', 255)->nullable();
            $table->text('title');
            $table->text('subtitle')->nullable();
            $table->string('background_image', 500)->nullable();
            $table->string('button1_text', 100)->nullable();
            $table->string('button1_url', 500)->nullable();
            $table->string('button1_variant', 30)->default('primary');
            $table->string('button2_text', 100)->nullable();
            $table->string('button2_url', 500)->nullable();
            $table->string('button2_variant', 30)->default('primary2');
            $table->boolean('is_enabled')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $slides = [
            [
                'tag' => 'WE ARE ENGITECH',
                'title' => 'IT Solutions & <br><span class="text-primary">Technology</span>',
                'subtitle' => 'We are the architects of the digital age, bringing innovative IT solutions and services to empower your business.',
                'background_image' => '/images/slider/slider1.jpg',
                'button1_text' => 'Our Services',
                'button1_url' => '/services',
                'button1_variant' => 'primary',
                'button2_text' => 'Learn More',
                'button2_url' => '/contact',
                'button2_variant' => 'primary2',
                'sort_order' => 0,
            ],
            [
                'tag' => 'CYBERSECURITY',
                'title' => 'Protect & Innovate Your <br><span class="text-primary">Digital Future</span>',
                'subtitle' => 'Advanced security frameworks to protect your data, ensuring trust and reliability in an interconnected world.',
                'background_image' => '/images/slider/slider2.jpg',
                'button1_text' => 'Discover More',
                'button1_url' => '/security',
                'button1_variant' => 'primary',
                'button2_text' => null,
                'button2_url' => null,
                'button2_variant' => 'primary2',
                'sort_order' => 1,
            ],
            [
                'tag' => 'CLOUD COMPUTING',
                'title' => 'Design & Tech Driven <br><span class="text-primary">Transformation</span>',
                'subtitle' => 'Scalable cloud infrastructure connecting systems and empowering businesses with actionable insights and performance.',
                'background_image' => '/images/slider/slider3.jpg',
                'button1_text' => 'Cloud Solutions',
                'button1_url' => '/cloud',
                'button1_variant' => 'primary',
                'button2_text' => 'Get Quote',
                'button2_url' => '/contact',
                'button2_variant' => 'primary2',
                'sort_order' => 2,
            ],
            [
                'tag' => 'WE ARE ZEHANAT',
                'title' => 'Software & AI Solutions For <br><span class="text-primary">Education</span>',
                'subtitle' => 'Empowering educators, students, researchers, and institutions across Khyber Pakhtunkhwa under AWKUM.',
                'background_image' => '/images/slider/slider4.jpg',
                'button1_text' => 'Become A Member',
                'button1_url' => '/membership',
                'button1_variant' => 'primary',
                'button2_text' => 'Explore Programs',
                'button2_url' => '/programs',
                'button2_variant' => 'primary2',
                'sort_order' => 3,
            ],
            [
                'tag' => 'FACULTY TRAINING',
                'title' => 'Empowering Educators With <br><span class="text-primary">Next-Gen AI Skills</span>',
                'subtitle' => 'Comprehensive workshops, lesson-planning assistants, and classroom integration modules for teachers.',
                'background_image' => '/images/slider/slider5.jpg',
                'button1_text' => 'Teacher Modules',
                'button1_url' => '/programs#schools',
                'button1_variant' => 'primary',
                'button2_text' => null,
                'button2_url' => null,
                'button2_variant' => 'primary2',
                'sort_order' => 4,
            ],
            [
                'tag' => 'ETHICAL & RESPONSIBLE AI',
                'title' => 'Building Trust & Standards in <br><span class="text-primary">Educational Tech</span>',
                'subtitle' => 'Promoting AI ethics, data privacy, student fairness, and academic integrity standards across educational institutions.',
                'background_image' => '/images/slider/slider6.jpg',
                'button1_text' => 'Read Guidelines',
                'button1_url' => '/pillars#ethics',
                'button1_variant' => 'primary',
                'button2_text' => 'FAQ & Support',
                'button2_url' => '/faq',
                'button2_variant' => 'primary2',
                'sort_order' => 5,
            ]
        ];

        foreach ($slides as &$slide) {
            $slide['is_enabled'] = true;
            $slide['created_at'] = $now;
            $slide['updated_at'] = $now;
        }

        DB::table('hero_slides')->insert($slides);
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
