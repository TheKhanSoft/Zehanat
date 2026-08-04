<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->string('type')->default('text');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->json('options')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $settings = [
            // General group
            ['key' => 'site_name', 'value' => 'ZEHANAT', 'group' => 'general', 'type' => 'text', 'label' => 'Site Name', 'description' => null, 'options' => null, 'sort_order' => 0],
            ['key' => 'site_tagline', 'value' => 'Intelligence · Innovation · Impact', 'group' => 'general', 'type' => 'text', 'label' => 'Site Tagline', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'org_full_name', 'value' => 'The Khyber Pakhtunkhwa Society for AI in Education', 'group' => 'general', 'type' => 'text', 'label' => 'Organization Full Name', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'org_university', 'value' => 'Abdul Wali Khan University Mardan', 'group' => 'general', 'type' => 'text', 'label' => 'Parent University', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'site_description', 'value' => 'Zehanat exists to bridge the AI knowledge gap in Khyber Pakhtunkhwa...', 'group' => 'general', 'type' => 'textarea', 'label' => 'Site Description', 'description' => null, 'options' => null, 'sort_order' => 4],
            ['key' => 'footer_description', 'value' => 'The Khyber Pakhtunkhwa Society for AI in Education — bridging artificial intelligence research, classroom pedagogy, and academic excellence under Abdul Wali Khan University Mardan.', 'group' => 'general', 'type' => 'textarea', 'label' => 'Footer Description', 'description' => null, 'options' => null, 'sort_order' => 5],
            ['key' => 'copyright_text', 'value' => '© 2025 Zehanat. All rights reserved.', 'group' => 'general', 'type' => 'text', 'label' => 'Copyright Text', 'description' => null, 'options' => null, 'sort_order' => 6],
            ['key' => 'site_logo_dark', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Site Logo (Dark Text / Light Background)', 'description' => 'Used in light navbars and areas with light backgrounds.', 'options' => null, 'sort_order' => 7],
            ['key' => 'site_logo_light', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Site Logo (Light Text / Dark Background)', 'description' => 'Used in dark navbars and footers.', 'options' => null, 'sort_order' => 8],
            ['key' => 'site_favicon', 'value' => '', 'group' => 'general', 'type' => 'image', 'label' => 'Favicon', 'description' => 'Must be a square image (e.g. 512x512).', 'options' => null, 'sort_order' => 9],
            
            // Contact group
            ['key' => 'contact_address', 'value' => 'Abdul Wali Khan University Mardan, Khyber Pakhtunkhwa, Pakistan', 'group' => 'contact', 'type' => 'text', 'label' => 'Full Address', 'description' => null, 'options' => null, 'sort_order' => 0],
            ['key' => 'contact_address_short', 'value' => 'AWKUM Campus, Mardan, KP', 'group' => 'contact', 'type' => 'text', 'label' => 'Short Address', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'contact_email', 'value' => 'zehanat@awkum.edu.pk', 'group' => 'contact', 'type' => 'text', 'label' => 'Contact Email', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'contact_phone', 'value' => '+92 937 9230640', 'group' => 'contact', 'type' => 'text', 'label' => 'Phone Number', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'contact_hours', 'value' => 'Mon - Fri: 8:00 AM - 4:00 PM', 'group' => 'contact', 'type' => 'text', 'label' => 'Working Hours', 'description' => null, 'options' => null, 'sort_order' => 4],
            ['key' => 'social_facebook', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'Facebook URL', 'description' => null, 'options' => null, 'sort_order' => 5],
            ['key' => 'social_twitter', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'Twitter/X URL', 'description' => null, 'options' => null, 'sort_order' => 6],
            ['key' => 'social_linkedin', 'value' => '#', 'group' => 'contact', 'type' => 'url', 'label' => 'LinkedIn URL', 'description' => null, 'options' => null, 'sort_order' => 7],
            ['key' => 'social_youtube', 'value' => '', 'group' => 'contact', 'type' => 'url', 'label' => 'YouTube URL', 'description' => null, 'options' => null, 'sort_order' => 8],
            ['key' => 'contact_map_url', 'value' => '', 'group' => 'contact', 'type' => 'url', 'label' => 'Google Maps Embed URL', 'description' => null, 'options' => null, 'sort_order' => 9],

            // Email group
            ['key' => 'mail_driver', 'value' => '', 'group' => 'email', 'type' => 'select', 'label' => 'Mail Driver', 'description' => null, 'options' => json_encode(["smtp", "sendmail", "log"]), 'sort_order' => 0],
            ['key' => 'mail_host', 'value' => '', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Host', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'mail_port', 'value' => '', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Port', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'mail_username', 'value' => '', 'group' => 'email', 'type' => 'text', 'label' => 'SMTP Username', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'mail_password', 'value' => '', 'group' => 'email', 'type' => 'password', 'label' => 'SMTP Password', 'description' => null, 'options' => null, 'sort_order' => 4],
            ['key' => 'mail_encryption', 'value' => '', 'group' => 'email', 'type' => 'select', 'label' => 'SMTP Encryption', 'description' => null, 'options' => json_encode(["tls", "ssl", "none"]), 'sort_order' => 5],
            ['key' => 'mail_from_address', 'value' => '', 'group' => 'email', 'type' => 'text', 'label' => 'Sender Email', 'description' => null, 'options' => null, 'sort_order' => 6],
            ['key' => 'mail_from_name', 'value' => '', 'group' => 'email', 'type' => 'text', 'label' => 'Sender Name', 'description' => null, 'options' => null, 'sort_order' => 7],

            // Features group
            ['key' => 'maintenance_mode', 'value' => '0', 'group' => 'features', 'type' => 'toggle', 'label' => 'Maintenance Mode', 'description' => null, 'options' => null, 'sort_order' => 0],
            ['key' => 'maintenance_message', 'value' => 'We are currently performing scheduled maintenance. Please check back shortly.', 'group' => 'features', 'type' => 'textarea', 'label' => 'Maintenance Message', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'membership_open', 'value' => '1', 'group' => 'features', 'type' => 'toggle', 'label' => 'Membership Registration Open', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'membership_closed_message', 'value' => 'Membership registration is currently closed. Please check back later.', 'group' => 'features', 'type' => 'text', 'label' => 'Membership Closed Message', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'contact_form_enabled', 'value' => '1', 'group' => 'features', 'type' => 'toggle', 'label' => 'Contact Form Enabled', 'description' => null, 'options' => null, 'sort_order' => 4],
            ['key' => 'contact_notification_email', 'value' => 'zehanat@awkum.edu.pk', 'group' => 'features', 'type' => 'text', 'label' => 'Contact Notification Email', 'description' => null, 'options' => null, 'sort_order' => 5],
            ['key' => 'show_news_section', 'value' => '1', 'group' => 'features', 'type' => 'toggle', 'label' => 'Show News Section on Homepage', 'description' => null, 'options' => null, 'sort_order' => 6],
            ['key' => 'show_faq_section', 'value' => '1', 'group' => 'features', 'type' => 'toggle', 'label' => 'Show FAQ Section on Homepage', 'description' => null, 'options' => null, 'sort_order' => 7],
            ['key' => 'show_cta_banner', 'value' => '1', 'group' => 'features', 'type' => 'toggle', 'label' => 'Show CTA Banner', 'description' => null, 'options' => null, 'sort_order' => 8],

            // SEO group
            ['key' => 'seo_title', 'value' => 'Zehanat - KP Society for AI in Education', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Title', 'description' => null, 'options' => null, 'sort_order' => 0],
            ['key' => 'seo_description', 'value' => 'Zehanat — The Khyber Pakhtunkhwa Society for AI in Education. Bringing Artificial Intelligence to Every Classroom.', 'group' => 'seo', 'type' => 'textarea', 'label' => 'Meta Description', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'seo_keywords', 'value' => 'AI, Education, Khyber Pakhtunkhwa, AWKUM, Zehanat, Artificial Intelligence, Pakistan', 'group' => 'seo', 'type' => 'text', 'label' => 'Meta Keywords', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'seo_og_image', 'value' => '/images/brand/og-image-1200x630.jpg', 'group' => 'seo', 'type' => 'text', 'label' => 'OG Image URL', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'seo_og_image_upload', 'value' => '', 'group' => 'seo', 'type' => 'image', 'label' => 'Default Open Graph Image', 'description' => 'Image shown when sharing the site on social media.', 'options' => null, 'sort_order' => 4],
            ['key' => 'analytics_google_id', 'value' => '', 'group' => 'seo', 'type' => 'text', 'label' => 'Google Analytics ID', 'description' => null, 'options' => null, 'sort_order' => 5],
            ['key' => 'analytics_enabled', 'value' => '0', 'group' => 'seo', 'type' => 'toggle', 'label' => 'Enable Analytics', 'description' => null, 'options' => null, 'sort_order' => 6],

            // Appearance group
            ['key' => 'theme_active', 'value' => 'default', 'group' => 'appearance', 'type' => 'select', 'label' => 'Active Theme', 'description' => null, 'options' => json_encode(["default", "ocean_teal", "royal_indigo", "emerald_green", "sunset_amber", "custom"]), 'sort_order' => 0],
            ['key' => 'theme_primary_color', 'value' => '#43baff', 'group' => 'appearance', 'type' => 'color', 'label' => 'Custom Primary Color', 'description' => null, 'options' => null, 'sort_order' => 1],
            ['key' => 'theme_secondary_color', 'value' => '#7141b1', 'group' => 'appearance', 'type' => 'color', 'label' => 'Custom Secondary Color', 'description' => null, 'options' => null, 'sort_order' => 2],
            ['key' => 'theme_dark_color', 'value' => '#1b1d21', 'group' => 'appearance', 'type' => 'color', 'label' => 'Custom Dark Color', 'description' => null, 'options' => null, 'sort_order' => 3],
            ['key' => 'top_strip_visible', 'value' => '1', 'group' => 'appearance', 'type' => 'toggle', 'label' => 'Top Strip Visible', 'description' => null, 'options' => null, 'sort_order' => 4],
            ['key' => 'hero_autoplay_speed', 'value' => '5000', 'group' => 'appearance', 'type' => 'number', 'label' => 'Hero Autoplay Speed (ms)', 'description' => null, 'options' => null, 'sort_order' => 5],
            ['key' => 'theme_font_heading', 'value' => 'Montserrat', 'group' => 'appearance', 'type' => 'select', 'label' => 'Heading Font', 'description' => null, 'options' => json_encode(["Montserrat" => "Montserrat", "Inter" => "Inter", "Roboto" => "Roboto", "Playfair Display" => "Playfair Display"]), 'sort_order' => 6],
            ['key' => 'theme_font_body', 'value' => 'Nunito Sans', 'group' => 'appearance', 'type' => 'select', 'label' => 'Body Font', 'description' => null, 'options' => json_encode(["Nunito Sans" => "Nunito Sans", "Open Sans" => "Open Sans", "Lato" => "Lato", "Inter" => "Inter"]), 'sort_order' => 7],
            ['key' => 'theme_border_radius', 'value' => '0.5rem', 'group' => 'appearance', 'type' => 'select', 'label' => 'Global Border Radius', 'description' => 'Affects buttons, cards, and UI elements.', 'options' => json_encode(["0px" => "Sharp (0px)", "0.5rem" => "Rounded (sm)", "1rem" => "Rounded (lg)", "9999px" => "Pill (Full)"]), 'sort_order' => 8],
            ['key' => 'theme_button_style', 'value' => 'solid', 'group' => 'appearance', 'type' => 'select', 'label' => 'Button Style', 'description' => null, 'options' => json_encode(["solid" => "Solid Colors", "gradient" => "Gradient Colors"]), 'sort_order' => 9],
            ['key' => 'theme_navbar_style', 'value' => 'sticky_light', 'group' => 'appearance', 'type' => 'select', 'label' => 'Navbar Style', 'description' => null, 'options' => json_encode(["sticky_light" => "Sticky (Light)", "transparent" => "Transparent to Solid", "dark" => "Dark Mode"]), 'sort_order' => 10],
            ['key' => 'theme_footer_style', 'value' => 'dark', 'group' => 'appearance', 'type' => 'select', 'label' => 'Footer Style', 'description' => null, 'options' => json_encode(["dark" => "Dark Background", "primary" => "Primary Color Background", "light" => "Light Background"]), 'sort_order' => 11],
            ['key' => 'theme_card_shadow', 'value' => 'shadow-md', 'group' => 'appearance', 'type' => 'select', 'label' => 'Card Shadows', 'description' => 'Global shadow depth for all cards.', 'options' => json_encode(["none" => "Flat (No Shadow, Border only)", "shadow-sm" => "Soft (Small)", "shadow-md" => "Medium", "shadow-xl" => "Hard (Large)"]), 'sort_order' => 12],
            ['key' => 'theme_custom_css', 'value' => '', 'group' => 'appearance', 'type' => 'textarea_code', 'label' => 'Custom CSS', 'description' => 'Inject raw CSS into the public site layout. Use carefully.', 'options' => null, 'sort_order' => 13],
        ];

        foreach ($settings as &$setting) {
            $setting['created_at'] = $now;
            $setting['updated_at'] = $now;
        }

        DB::table('settings')->insert($settings);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

