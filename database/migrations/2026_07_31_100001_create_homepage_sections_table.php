<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('block_id', 50)->unique();
            $table->string('title', 255);
            $table->string('icon', 10)->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('content')->nullable();
            $table->timestamps();
        });

        $now = now();
        
        $sections = [
            [
                'block_id' => 'hero', 
                'title' => 'Hero Slider', 
                'icon' => '🖼️', 
                'sort_order' => 0, 
                'content' => json_encode(['tag' => 'Hero Section', 'description' => 'Full-width hero slider with rotating slides'])
            ],
            [
                'block_id' => 'welcome', 
                'title' => 'Welcome Note & Leadership', 
                'icon' => '👋', 
                'sort_order' => 1, 
                'content' => json_encode([
                    'tag' => 'ABOUT ZEHANAT', 
                    'heading' => 'Closing the AI Knowledge Gap in Khyber Pakhtunkhwa', 
                    'body' => '<p>Zehanat is an initiative to bridge the AI knowledge gap...</p><p>By connecting students, researchers and industry experts...</p>', 
                    'button_text' => 'Read Our Story', 
                    'button_url' => '/about', 
                    'helpline' => '+92 937 9230640', 
                    'vc_name' => 'Prof. Dr. Jamil Ahmad', 
                    'vc_designation' => 'Patron & Founder, Vice Chancellor AWKUM', 
                    'vc_quote' => '"Whether you are a headteacher wondering what AI means for your school, a college principal planning modern curricula, or a university researcher — Zehanat is your collaborative forum."', 
                    'vc_image' => '/images/vc_face.png', 
                    'card_footer_left' => 'AWKUM ACADEMIC LEADERSHIP', 
                    'card_footer_right' => 'Mardan, KP'
                ])
            ],
            [
                'block_id' => 'pillars', 
                'title' => 'Our Six Pillars', 
                'icon' => '🏛️', 
                'sort_order' => 2, 
                'content' => json_encode([
                    'tag' => 'OUR FOUNDATION', 
                    'heading' => 'The Six Pillars of Zehanat', 
                    'subtitle' => 'Structuring our mission to empower education across Khyber Pakhtunkhwa.', 
                    'items' => [
                        ['icon' => '🎓', 'number' => '1', 'title' => 'AI Literacy & Awareness', 'link' => '/pillars#literacy'],
                        ['icon' => '🔬', 'number' => '2', 'title' => 'Research & Development', 'link' => '/pillars#research'],
                        ['icon' => '🏫', 'number' => '3', 'title' => 'Academic Integration', 'link' => '/pillars#academic'],
                        ['icon' => '💻', 'number' => '4', 'title' => 'Skill Development', 'link' => '/pillars#skills'],
                        ['icon' => '🤝', 'number' => '5', 'title' => 'Community Outreach', 'link' => '/pillars#community'],
                        ['icon' => '⚖️', 'number' => '6', 'title' => 'Ethics & Guidelines', 'link' => '/pillars#ethics']
                    ]
                ])
            ],
            [
                'block_id' => 'join_movement', 
                'title' => 'Target Sectors / Join Movement', 
                'icon' => '🚀', 
                'sort_order' => 3, 
                'content' => json_encode([
                    'tag' => 'JOIN THE MOVEMENT', 
                    'heading' => 'Be Part of Khyber Pakhtunkhwa\'s AI Revolution', 
                    'items' => [
                        ['icon' => '🧑🤝🧑', 'title' => 'Individual Members', 'description' => 'Join as an educator, researcher, student...', 'button_text' => 'Join Now', 'button_url' => '/membership'],
                        ['icon' => '🏫', 'title' => 'Partner Institutions', 'description' => 'Schools, colleges, and universities...', 'button_text' => 'Partner With Us', 'button_url' => '/contact'],
                        ['icon' => '💼', 'title' => 'Industry Partners', 'description' => 'Tech companies and startups...', 'button_text' => 'Collaborate', 'button_url' => '/contact'],
                        ['icon' => '📚', 'title' => 'Content Contributors', 'description' => 'Contribute to our AI curriculum...', 'button_text' => 'Contribute', 'button_url' => '/contact']
                    ]
                ])
            ],
            [
                'block_id' => 'stats', 
                'title' => 'Stats Counter Bar', 
                'icon' => '📊', 
                'sort_order' => 4, 
                'content' => json_encode([
                    'items' => [
                        ['number' => '50', 'suffix' => '+', 'label' => 'Partner Institutions'], 
                        ['number' => '500', 'suffix' => '+', 'label' => 'Active Members'], 
                        ['number' => '30', 'suffix' => '+', 'label' => 'Planned Workshops'], 
                        ['number' => '6', 'suffix' => '', 'label' => 'Core AI Pillars']
                    ]
                ])
            ],
            [
                'block_id' => 'news_events', 
                'title' => 'Latest News & Events', 
                'icon' => '📰', 
                'sort_order' => 5, 
                'content' => json_encode([
                    'tag' => 'LATEST UPDATES', 
                    'heading' => 'News & Upcoming Events', 
                    'button_text' => 'View All Events →', 
                    'button_url' => '/news-events', 
                    'max_items' => 6
                ])
            ],
            [
                'block_id' => 'initiatives', 
                'title' => 'Image Card Carousel', 
                'icon' => '🎯', 
                'sort_order' => 6, 
                'content' => json_encode([
                    'tag' => 'OUR INITIATIVES', 
                    'heading' => 'Recent Projects & Programs', 
                    'items' => [
                        ['title' => 'AI Lab Setup', 'category' => 'Infrastructure', 'image' => '/images/dummy/project_1.jpg'], 
                        ['title' => 'Educator Workshop', 'category' => 'Training', 'image' => '/images/dummy/project_2.jpg'], 
                        ['title' => 'Student Outreach', 'category' => 'Community', 'image' => '/images/dummy/project_3.jpg'], 
                        ['title' => 'Curriculum Design', 'category' => 'Academics', 'image' => '/images/dummy/stat_1.jpg']
                    ]
                ])
            ],
            [
                'block_id' => 'focus_areas', 
                'title' => 'Icon Overlay Grid', 
                'icon' => '🔷', 
                'sort_order' => 7, 
                'content' => json_encode([
                    'tag' => 'CORE PILLARS', 
                    'heading' => 'Our Core Focus Areas', 
                    'bg_image' => '/images/dummy/tech_bg.jpg', 
                    'items' => [
                        ['title' => 'Research'], ['title' => 'Development'], ['title' => 'Training'], 
                        ['title' => 'Outreach'], ['title' => 'Ethics'], ['title' => 'Community']
                    ]
                ])
            ],
            [
                'block_id' => 'testimonials', 
                'title' => 'Testimonial Slider', 
                'icon' => '💬', 
                'sort_order' => 8, 
                'content' => json_encode([
                    'tag' => 'TESTIMONIALS', 
                    'heading' => 'What Educators Are Saying'
                ])
            ],
            [
                'block_id' => 'features_stats', 
                'title' => 'Feature Stat Grid', 
                'icon' => '⚡', 
                'sort_order' => 9, 
                'content' => json_encode([
                    'tag' => 'WHY CHOOSE US', 
                    'heading' => 'Design the Concept of Your Business Idea Now', 
                    'features' => [
                        ['title' => 'Curriculum Design'], ['title' => 'Skill Development'], 
                        ['title' => 'Data Analytics'], ['title' => 'Cyber Security']
                    ], 
                    'stats' => [
                        ['number' => '15', 'suffix' => '+', 'title' => 'Districts Reached', 'image' => '/images/dummy/stat_1.jpg'], 
                        ['number' => '23', 'suffix' => 'k', 'title' => 'Happy Educators', 'image' => '/images/dummy/stat_2.jpg']
                    ]
                ])
            ],
            [
                'block_id' => 'cta_banner', 
                'title' => 'CTA Banner', 
                'icon' => '📢', 
                'sort_order' => 10, 
                'content' => json_encode([
                    'title' => 'Ready to Shape the Future of AI in Education?', 
                    'subtitle' => 'Join Zehanat today and lead the AI revolution in Khyber Pakhtunkhwa\'s classrooms.', 
                    'badge_text' => 'JOIN KHYBER PAKHTUNKHWA AI MOVEMENT', 
                    'button1_text' => 'Become a Member', 
                    'button1_url' => '/membership', 
                    'button1_variant' => 'primary', 
                    'button2_text' => 'Contact Us', 
                    'button2_url' => '/contact', 
                    'button2_variant' => 'outline'
                ])
            ]
        ];

        foreach ($sections as &$section) {
            $section['created_at'] = $now;
            $section['updated_at'] = $now;
        }

        DB::table('homepage_sections')->insert($sections);
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
