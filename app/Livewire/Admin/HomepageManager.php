<?php

namespace App\Livewire\Admin;

use App\Models\HeroSlide;
use App\Models\HomepageSection;
use App\Models\Testimonial;
use Livewire\Component;
use Livewire\Attributes\On;

class HomepageManager extends Component
{
    // Active view: 'sections', 'hero-slides', 'testimonials'
    public string $activeView = 'sections';

    // Section editing
    public ?int $editingSectionId = null;
    public array $sectionContent = [];
    public string $createTitle = '';
    public string $createTemplate = 'welcome';

    // Hero Slide form
    public ?int $slideId = null;
    public string $slideTag = '';
    public string $slideTitle = '';
    public string $slideSubtitle = '';
    public string $slideBgImage = '';
    public string $slideBtn1Text = '';
    public string $slideBtn1Url = '';
    public string $slideBtn1Variant = 'primary';
    public string $slideBtn2Text = '';
    public string $slideBtn2Url = '';
    public string $slideBtn2Variant = 'primary2';
    public bool $slideEnabled = true;
    public int $slideSortOrder = 0;

    // Testimonial form
    public ?int $testimonialId = null;
    public string $authorName = '';
    public string $authorDesignation = '';
    public string $authorOrganization = '';
    public string $authorAvatar = '';
    public string $testimonialQuote = '';
    public bool $testimonialEnabled = true;
    public int $testimonialSortOrder = 0;

    protected $listeners = [
        'media-selected-homepage-flat' => 'updateImageHomepageFlat',
        'media-selected-homepage' => 'updateImageHomepageArray',
        'media-selected-slide' => 'updateImageSlide'
    ];

    public function updateImageSlide($url, $params)
    {
        $key = is_array($params) ? $params[0] : $params;
        if (property_exists($this, $key)) {
            $this->$key = $url;
        }
    }

    public function updateImageHomepageFlat($url, $params)
    {
        $key = is_array($params) ? $params[0] : $params;
        if (isset($this->sectionContent[$key])) {
            $this->sectionContent[$key] = $url;
        }
    }

    public function updateImageHomepageArray($url, $params)
    {
        if (is_array($params) && count($params) >= 3) {
            $key = $params[0];
            $index = $params[1];
            $itemKey = $params[2];
            
            if (isset($this->sectionContent[$key][$index][$itemKey])) {
                $this->sectionContent[$key][$index][$itemKey] = $url;
            }
        }
    }

    public function mount()
    {
        abort_if(!auth()->user()->can('view homepage'), 403);
    }

    public function switchView(string $view)
    {
        $this->activeView = $view;
    }

    // ──────────────────────────────────────────
    // Section Management
    // ──────────────────────────────────────────

    public function toggleSection(int $id)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);

        $section = HomepageSection::findOrFail($id);
        $section->is_enabled = !$section->is_enabled;
        $section->save();

        $this->dispatch('notify',
            message: $section->title . ($section->is_enabled ? ' enabled.' : ' disabled.'),
            type: 'success'
        );
    }

    public function updateSectionOrder(array $orderedIds)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);

        foreach ($orderedIds as $index => $id) {
            HomepageSection::where('id', $id)->update(['sort_order' => $index]);
        }

        $this->dispatch('notify', message: 'Section order updated.', type: 'success');
    }

    public function updateSlideOrder(array $orderedIds)
    {
        abort_if(!auth()->user()->can('edit hero slides'), 403);

        foreach ($orderedIds as $index => $id) {
            HeroSlide::where('id', $id)->update(['sort_order' => $index]);
        }

        $this->dispatch('notify', message: 'Slide order updated.', type: 'success');
    }

    public function updateTestimonialOrder(array $orderedIds)
    {
        abort_if(!auth()->user()->can('edit testimonials'), 403);

        foreach ($orderedIds as $index => $id) {
            Testimonial::where('id', $id)->update(['sort_order' => $index]);
        }

        $this->dispatch('notify', message: 'Testimonial order updated.', type: 'success');
    }

    public function editSection(int $id)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);

        $section = HomepageSection::findOrFail($id);
        $this->editingSectionId = $section->id;
        $this->sectionContent = $section->content ?? [];

        $this->dispatch('open-modal', id: 'sectionEditorModal');
    }

    public function saveSection()
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);

        $section = HomepageSection::findOrFail($this->editingSectionId);
        $section->content = $this->sectionContent;
        $section->save();

        $this->dispatch('close-modal', id: 'sectionEditorModal');
        $this->dispatch('notify', message: $section->title . ' updated successfully.', type: 'success');
        $this->editingSectionId = null;
        $this->sectionContent = [];
    }

    public function openCreateSection()
    {
        abort_if(!auth()->user()->can('create homepage sections'), 403);
        $this->createTitle = '';
        $this->createTemplate = 'welcome';
        $this->createIcon = '✨';
        $this->createEnabled = true;
        $this->dispatch('open-modal', id: 'createSectionModal');
    }

    public function saveNewSection()
    {
        abort_if(!auth()->user()->can('create homepage sections'), 403);

        $this->validate([
            'createTitle' => 'required|string|max:255',
            'createTemplate' => 'required|string',
            'createIcon' => 'nullable|string|max:10',
            'createEnabled' => 'boolean',
        ]);

        $defaultContents = [
            'welcome' => [
                'tag' => 'ABOUT', 'heading' => 'Welcome', 'body' => '<p>New block.</p>', 'button_text' => 'Read More', 'button_url' => '#',
                'leadership_name' => 'Prof. Dr. Jamil Ahmad', 'leadership_role' => 'Patron & Founder, Vice Chancellor AWKUM',
                'leadership_quote' => '"Whether you are a headteacher wondering what AI means for your school, a college principal planning modern curricula, or a university researcher — Zehanat is your collaborative forum."',
                'leadership_image' => '', 'leadership_footer_left' => 'AWKUM ACADEMIC LEADERSHIP', 'leadership_footer_right' => 'Mardan, KP',
                'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90'
            ],
            'pillars' => ['tag' => 'FOUNDATION', 'heading' => 'Pillars', 'bg_image' => '', 'bg_overlay_color' => '#f4f6f9', 'bg_overlay_opacity' => '90', 'items' => []],
            'join_movement' => ['tag' => 'JOIN', 'heading' => 'Target Sectors', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90', 'items' => []],
            'stats' => ['bg_image' => '', 'bg_overlay_color' => '#f4f6f9', 'bg_overlay_opacity' => '90', 'items' => []],
            'news_events' => ['tag' => 'UPDATES', 'heading' => 'Latest News', 'button_text' => 'View All', 'max_items' => 6, 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90'],
            'initiatives' => ['tag' => 'PROJECTS', 'heading' => 'Initiatives', 'bg_image' => '', 'bg_overlay_color' => '#f4f6f9', 'bg_overlay_opacity' => '90', 'items' => []],
            'focus_areas' => ['tag' => 'FOCUS', 'heading' => 'Focus Areas', 'bg_image' => '', 'bg_overlay_color' => '#1b1d21', 'bg_overlay_opacity' => '90', 'items' => []],
            'testimonials' => ['tag' => 'TESTIMONIALS', 'heading' => 'What They Say', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90'],
            'features_stats' => ['tag' => 'FEATURES', 'heading' => 'Why Choose Us', 'bg_image' => '', 'bg_overlay_color' => '#171822', 'bg_overlay_opacity' => '90', 'features' => [], 'stats' => []],
            'cta_banner' => ['title' => 'Ready?', 'subtitle' => 'Join us today.', 'button1_text' => 'Click Here', 'button1_url' => '#', 'bg_image' => '', 'bg_overlay_color' => '#1b1d21', 'bg_overlay_opacity' => '90'],
            'faq_accordion' => ['tag' => 'FAQS', 'heading' => 'Frequently Asked Questions', 'bg_image' => '', 'bg_overlay_color' => '#f8fafc', 'bg_overlay_opacity' => '90', 'items' => [
                ['question' => 'What is Zehanat?', 'answer' => 'Zehanat is an initiative...'],
                ['question' => 'How can I join?', 'answer' => 'You can join by...']
            ]],
            'team_grid' => ['tag' => 'OUR TEAM', 'heading' => 'Advisory Board', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90', 'items' => [
                ['name' => 'John Doe', 'role' => 'Director', 'image' => '', 'linkedin' => '#'],
                ['name' => 'Jane Smith', 'role' => 'Advisor', 'image' => '', 'linkedin' => '#']
            ]],
            'contact_map' => ['tag' => 'CONTACT', 'heading' => 'Get In Touch', 'address' => 'AWKUM, Mardan', 'email' => 'info@zehanat.com', 'phone' => '+92 000 0000000', 'map_url' => 'https://www.google.com/maps/embed?pb=!1m18...', 'bg_image' => '', 'bg_overlay_color' => '#f8fafc', 'bg_overlay_opacity' => '90'],
            'pricing_table' => ['tag' => 'PRICING', 'heading' => 'Membership Plans', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90', 'items' => [
                ['plan' => 'Basic', 'price' => 'Free', 'features' => 'Access to community, Monthly newsletter'],
                ['plan' => 'Pro', 'price' => '$9.99/mo', 'features' => 'Premium resources, Private workshops']
            ]],
            'video_showcase' => ['tag' => 'WATCH', 'heading' => 'See AI In Action', 'video_url' => 'https://www.youtube.com/embed/...', 'description' => 'A brief overview of our mission.', 'bg_image' => '', 'bg_overlay_color' => '#1b1d21', 'bg_overlay_opacity' => '90'],
            'custom_html' => ['raw_html' => '<div class="py-20 text-center">\n    <h2 class="text-3xl font-bold">Custom Block</h2>\n    <p>Replace this with your own HTML.</p>\n</div>', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90'],
            'timeline_history' => ['tag' => 'ROADMAP', 'heading' => 'Our Journey', 'bg_image' => '', 'bg_overlay_color' => '#ffffff', 'bg_overlay_opacity' => '90', 'items' => [
                ['year' => '2024', 'title' => 'Foundation', 'description' => 'Zehanat was founded.'],
                ['year' => '2025', 'title' => 'Expansion', 'description' => 'Expanded to 15 districts.']
            ]],
            'gallery_masonry' => ['tag' => 'GALLERY', 'heading' => 'Event Highlights', 'bg_image' => '', 'bg_overlay_color' => '#f4f6f9', 'bg_overlay_opacity' => '90', 'items' => [
                ['image' => '/images/dummy/project_1.jpg', 'caption' => 'Workshop 1'],
                ['image' => '/images/dummy/project_2.jpg', 'caption' => 'Workshop 2']
            ]],
        ];

        $content = $defaultContents[$this->createTemplate] ?? [];

        // Generate a unique block_id (slug)
        $baseId = \Str::slug($this->createTitle);
        $blockId = $baseId;
        $counter = 1;
        while (HomepageSection::where('block_id', $blockId)->exists()) {
            $blockId = $baseId . '-' . $counter;
            $counter++;
        }

        $sortOrder = HomepageSection::max('sort_order') + 1;

        HomepageSection::create([
            'block_id' => $blockId,
            'title' => $this->createTitle,
            'icon' => $this->createIcon ?: '✨',
            'is_enabled' => $this->createEnabled,
            'sort_order' => $sortOrder,
            'layout_template' => $this->createTemplate,
            'content' => $content,
        ]);

        $this->dispatch('close-modal', id: 'createSectionModal');
        $this->dispatch('notify', message: 'New block created successfully!', type: 'success');
    }

    public function addArrayItem(string $key)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);
        if (!isset($this->sectionContent[$key]) || !is_array($this->sectionContent[$key])) {
            return;
        }

        $items = $this->sectionContent[$key];
        $newItem = [];
        
        $section = HomepageSection::find($this->editingSectionId);
        $template = $section ? $section->block_id : null; // Note: use block_id since layout_template was removed and we use block_id as identifier in seeder

        $defaultItemStructures = [
            'pillars' => ['icon' => '', 'title' => '', 'description' => ''],
            'join_movement' => ['icon' => '', 'title' => '', 'description' => '', 'button_text' => '', 'button_url' => '', 'is_primary' => ''],
            'stats' => ['number' => '', 'label' => '', 'suffix' => ''],
            'initiatives' => ['image' => '', 'title' => '', 'description' => ''],
            'focus_areas' => ['icon' => '', 'title' => '', 'description' => '', 'link' => ''],
            'features_stats' => ['icon' => '', 'title' => '', 'description' => ''],
            'faq_accordion' => ['question' => '', 'answer' => ''],
            'team_grid' => ['name' => '', 'role' => '', 'image' => '', 'linkedin' => ''],
            'pricing_table' => ['plan' => '', 'price' => '', 'features' => ''],
            'timeline_history' => ['year' => '', 'title' => '', 'description' => ''],
            'gallery_masonry' => ['image' => '', 'caption' => ''],
        ];

        // Ensure we always use the full structure for the new item, rather than just copying the potentially incomplete last item
        if ($template && isset($defaultItemStructures[$template])) {
            $newItem = $defaultItemStructures[$template];
        } elseif (count($items) > 0) {
            $lastItem = end($items);
            if (is_array($lastItem)) {
                foreach (array_keys($lastItem) as $itemKey) {
                    $newItem[$itemKey] = '';
                }
            } else {
                $newItem = '';
            }
        } else {
            $newItem = '';
        }
        
        $this->sectionContent[$key][] = $newItem;
        $this->sectionContent = $this->sectionContent;
    }

    public function removeArrayItem(string $key, int $index)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);
        if (isset($this->sectionContent[$key][$index])) {
            unset($this->sectionContent[$key][$index]);
            $this->sectionContent[$key] = array_values($this->sectionContent[$key]);
            $this->sectionContent = $this->sectionContent;
        }
    }

    public function confirmDeleteSection(int $id)
    {
        abort_if(!auth()->user()->can('delete homepage sections'), 403);

        $this->dispatch('confirm-action', 
            title: 'Delete Block', 
            message: 'Are you sure you want to permanently delete this block?', 
            action: 'delete-section', 
            params: [$id]
        );
    }

    #[On('delete-section')]
    public function deleteSection(int $id)
    {
        abort_if(!auth()->user()->can('delete homepage sections'), 403);
        HomepageSection::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Block deleted successfully.', type: 'success');
    }

    public function moveSectionUp(int $id)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);
        $this->moveSection($id, -1);
    }

    public function moveSectionDown(int $id)
    {
        abort_if(!auth()->user()->can('edit homepage'), 403);
        $this->moveSection($id, 1);
    }

    private function moveSection(int $id, int $direction): void
    {
        $sections = HomepageSection::orderBy('sort_order')->get();
        $currentIndex = $sections->search(fn($s) => $s->id === $id);

        if ($currentIndex === false) return;

        $newIndex = $currentIndex + $direction;
        if ($newIndex < 0 || $newIndex >= $sections->count()) return;

        // Swap sort orders
        $current = $sections[$currentIndex];
        $target = $sections[$newIndex];

        $tempOrder = $current->sort_order;
        $current->sort_order = $target->sort_order;
        $target->sort_order = $tempOrder;

        $current->save();
        $target->save();
    }

    // ──────────────────────────────────────────
    // Hero Slide CRUD
    // ──────────────────────────────────────────

    public function createSlide()
    {
        abort_if(!auth()->user()->can('create hero slides'), 403);

        $this->resetSlideForm();
        $this->slideSortOrder = HeroSlide::max('sort_order') + 1;
        $this->dispatch('open-modal', id: 'slideModal');
    }

    public function editSlide(int $id)
    {
        abort_if(!auth()->user()->can('edit hero slides'), 403);

        $slide = HeroSlide::findOrFail($id);

        $this->slideId = $slide->id;
        $this->slideTag = $slide->tag ?? '';
        $this->slideTitle = $slide->title;
        $this->slideSubtitle = $slide->subtitle ?? '';
        $this->slideBgImage = $slide->background_image ?? '';
        $this->slideBtn1Text = $slide->button1_text ?? '';
        $this->slideBtn1Url = $slide->button1_url ?? '';
        $this->slideBtn1Variant = $slide->button1_variant ?? 'primary';
        $this->slideBtn2Text = $slide->button2_text ?? '';
        $this->slideBtn2Url = $slide->button2_url ?? '';
        $this->slideBtn2Variant = $slide->button2_variant ?? 'primary2';
        $this->slideEnabled = (bool) $slide->is_enabled;
        $this->slideSortOrder = $slide->sort_order;

        $this->dispatch('open-modal', id: 'slideModal');
    }

    public function saveSlide()
    {
        abort_if(!auth()->user()->can($this->slideId ? 'edit hero slides' : 'create hero slides'), 403);

        $validated = $this->validate([
            'slideTag' => 'nullable|string|max:255',
            'slideTitle' => 'required|string',
            'slideSubtitle' => 'nullable|string',
            'slideBgImage' => 'nullable|string|max:500',
            'slideBtn1Text' => 'nullable|string|max:100',
            'slideBtn1Url' => 'nullable|string|max:500',
            'slideBtn1Variant' => 'nullable|string|max:30',
            'slideBtn2Text' => 'nullable|string|max:100',
            'slideBtn2Url' => 'nullable|string|max:500',
            'slideBtn2Variant' => 'nullable|string|max:30',
            'slideEnabled' => 'boolean',
            'slideSortOrder' => 'integer',
        ]);

        $data = [
            'tag' => $this->slideTag,
            'title' => $this->slideTitle,
            'subtitle' => $this->slideSubtitle,
            'background_image' => $this->slideBgImage,
            'button1_text' => $this->slideBtn1Text,
            'button1_url' => $this->slideBtn1Url,
            'button1_variant' => $this->slideBtn1Variant,
            'button2_text' => $this->slideBtn2Text,
            'button2_url' => $this->slideBtn2Url,
            'button2_variant' => $this->slideBtn2Variant,
            'is_enabled' => $this->slideEnabled,
            'sort_order' => $this->slideSortOrder,
        ];

        if ($this->slideId) {
            HeroSlide::findOrFail($this->slideId)->update($data);
            $message = 'Slide updated successfully.';
        } else {
            HeroSlide::create($data);
            $message = 'Slide created successfully.';
        }

        $this->dispatch('close-modal', id: 'slideModal');
        $this->dispatch('notify', message: $message, type: 'success');
        $this->resetSlideForm();
    }

    public function toggleSlide(int $id)
    {
        abort_if(!auth()->user()->can('edit hero slides'), 403);

        $slide = HeroSlide::findOrFail($id);
        $slide->is_enabled = !$slide->is_enabled;
        $slide->save();

        $this->dispatch('notify',
            message: 'Slide ' . ($slide->is_enabled ? 'enabled' : 'disabled') . '.',
            type: 'success'
        );
    }

    public function confirmDeleteSlide(int $id)
    {
        abort_if(!auth()->user()->can('delete hero slides'), 403);

        $this->dispatch('confirm-action',
            title: 'Delete Slide',
            message: 'Are you sure you want to delete this hero slide? This action cannot be undone.',
            action: 'delete-slide',
            params: [$id]
        );
    }

    #[On('delete-slide')]
    public function deleteSlide(int $id)
    {
        abort_if(!auth()->user()->can('delete hero slides'), 403);

        HeroSlide::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Slide deleted successfully.', type: 'success');
    }

    private function resetSlideForm(): void
    {
        $this->slideId = null;
        $this->slideTag = '';
        $this->slideTitle = '';
        $this->slideSubtitle = '';
        $this->slideBgImage = '';
        $this->slideBtn1Text = '';
        $this->slideBtn1Url = '';
        $this->slideBtn1Variant = 'primary';
        $this->slideBtn2Text = '';
        $this->slideBtn2Url = '';
        $this->slideBtn2Variant = 'primary2';
        $this->slideEnabled = true;
        $this->slideSortOrder = 0;
    }

    // ──────────────────────────────────────────
    // Testimonial CRUD
    // ──────────────────────────────────────────

    public function createTestimonial()
    {
        abort_if(!auth()->user()->can('create testimonials'), 403);

        $this->resetTestimonialForm();
        $this->testimonialSortOrder = Testimonial::max('sort_order') + 1;
        $this->dispatch('open-modal', id: 'testimonialModal');
    }

    public function editTestimonial(int $id)
    {
        abort_if(!auth()->user()->can('edit testimonials'), 403);

        $t = Testimonial::findOrFail($id);

        $this->testimonialId = $t->id;
        $this->authorName = $t->author_name;
        $this->authorDesignation = $t->author_designation ?? '';
        $this->authorOrganization = $t->author_organization ?? '';
        $this->authorAvatar = $t->author_avatar ?? '';
        $this->testimonialQuote = $t->quote;
        $this->testimonialEnabled = (bool) $t->is_enabled;
        $this->testimonialSortOrder = $t->sort_order;

        $this->dispatch('open-modal', id: 'testimonialModal');
    }

    public function saveTestimonial()
    {
        abort_if(!auth()->user()->can($this->testimonialId ? 'edit testimonials' : 'create testimonials'), 403);

        $this->validate([
            'authorName' => 'required|string|max:255',
            'authorDesignation' => 'nullable|string|max:255',
            'authorOrganization' => 'nullable|string|max:255',
            'authorAvatar' => 'nullable|string|max:500',
            'testimonialQuote' => 'required|string',
            'testimonialEnabled' => 'boolean',
            'testimonialSortOrder' => 'integer',
        ]);

        $data = [
            'author_name' => $this->authorName,
            'author_designation' => $this->authorDesignation,
            'author_organization' => $this->authorOrganization,
            'author_avatar' => $this->authorAvatar,
            'quote' => $this->testimonialQuote,
            'is_enabled' => $this->testimonialEnabled,
            'sort_order' => $this->testimonialSortOrder,
        ];

        if ($this->testimonialId) {
            Testimonial::findOrFail($this->testimonialId)->update($data);
            $message = 'Testimonial updated successfully.';
        } else {
            Testimonial::create($data);
            $message = 'Testimonial created successfully.';
        }

        $this->dispatch('close-modal', id: 'testimonialModal');
        $this->dispatch('notify', message: $message, type: 'success');
        $this->resetTestimonialForm();
    }

    public function toggleTestimonial(int $id)
    {
        abort_if(!auth()->user()->can('edit testimonials'), 403);

        $t = Testimonial::findOrFail($id);
        $t->is_enabled = !$t->is_enabled;
        $t->save();

        $this->dispatch('notify',
            message: 'Testimonial ' . ($t->is_enabled ? 'enabled' : 'disabled') . '.',
            type: 'success'
        );
    }

    public function confirmDeleteTestimonial(int $id)
    {
        abort_if(!auth()->user()->can('delete testimonials'), 403);

        $this->dispatch('confirm-action',
            title: 'Delete Testimonial',
            message: 'Are you sure you want to delete this testimonial? This action cannot be undone.',
            action: 'delete-testimonial',
            params: [$id]
        );
    }

    #[On('delete-testimonial')]
    public function deleteTestimonial(int $id)
    {
        abort_if(!auth()->user()->can('delete testimonials'), 403);

        Testimonial::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Testimonial deleted successfully.', type: 'success');
    }

    private function resetTestimonialForm(): void
    {
        $this->testimonialId = null;
        $this->authorName = '';
        $this->authorDesignation = '';
        $this->authorOrganization = '';
        $this->authorAvatar = '';
        $this->testimonialQuote = '';
        $this->testimonialEnabled = true;
        $this->testimonialSortOrder = 0;
    }

    // ──────────────────────────────────────────
    // Render
    // ──────────────────────────────────────────

    public function render()
    {
        $sections = HomepageSection::orderBy('sort_order')->get();
        $heroSlides = HeroSlide::orderBy('sort_order')->get();
        $testimonials = Testimonial::orderBy('sort_order')->get();

        $editingSection = $this->editingSectionId
            ? HomepageSection::find($this->editingSectionId)
            : null;

        return view('livewire.admin.homepage-manager', [
            'sections' => $sections,
            'heroSlides' => $heroSlides,
            'testimonials' => $testimonials,
            'editingSection' => $editingSection,
            'totalSections' => $sections->count(),
            'enabledSections' => $sections->where('is_enabled', true)->count(),
            'totalSlides' => $heroSlides->count(),
            'totalTestimonials' => $testimonials->count(),
        ])->layout('layouts.admin');
    }
}
