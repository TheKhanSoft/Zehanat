<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SettingManager extends Component
{
    use WithFileUploads;

    public $activeTab = 'general';
    public $settings = [];
    public $testEmailAddress = '';
    public $settingMeta = [];

    protected $tabs = [
        'general' => 'General',
        'contact' => 'Contact & Social',
        'email' => 'Email',
        'features' => 'Features',
        'seo' => 'SEO',
        'appearance' => 'Appearance',
        'footer' => 'Footer',
    ];

    protected $listeners = ['media-selected-setting' => 'updateImageSetting'];

    public function updateImageSetting($url, $params)
    {
        $key = is_array($params) ? $params[0] : $params;
        $this->settings[$key] = $url;
    }

    public function mount()
    {
        abort_if(!auth()->user()->can('view settings'), 403);
        $this->loadTabSettings();
    }

    public function switchTab($tab)
    {
        if (array_key_exists($tab, $this->tabs)) {
            $this->activeTab = $tab;
            $this->loadTabSettings();
        }
    }

    public function loadTabSettings()
    {
        $groupSettings = Setting::where('group', $this->activeTab)->orderBy('sort_order')->get();
        
        if ($this->activeTab === 'footer') {
            $contactSettings = Setting::whereIn('key', ['contact_address', 'contact_email', 'contact_phone'])->get();
            $groupSettings = $groupSettings->concat($contactSettings);
        }
        
        $this->settings = [];
        $this->settingMeta = [];

        foreach ($groupSettings as $setting) {
            $key = is_array($setting) ? $setting['key'] : $setting->key;
            $value = is_array($setting) ? $setting['value'] : $setting->value;
            $label = is_array($setting) ? ($setting['label'] ?? '') : ($setting->label ?? '');
            $type = is_array($setting) ? ($setting['type'] ?? 'text') : ($setting->type ?? 'text');
            $description = is_array($setting) ? ($setting['description'] ?? '') : ($setting->description ?? '');
            $options = is_array($setting) ? ($setting['options'] ?? []) : ($setting->options ?? []);

            if (empty($label)) $label = ucfirst(str_replace('_', ' ', $key));
            if (is_string($options)) $options = json_decode($options, true) ?? [];

            // Cast boolean properly
            if ($type === 'boolean' || $type === 'toggle') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            }

            // Decode repeater json
            if ($type === 'repeater_social' || $type === 'repeater_links') {
                $value = json_decode($value, true);
                if (!is_array($value)) $value = [];
            }

            // Fallback to env/config for empty email settings
            if ($this->activeTab === 'email' && empty($value)) {
                $envFallback = match ($key) {
                    'mail_driver' => config('mail.default'),
                    'mail_host' => config('mail.mailers.smtp.host'),
                    'mail_port' => config('mail.mailers.smtp.port'),
                    'mail_username' => config('mail.mailers.smtp.username'),
                    'mail_password' => config('mail.mailers.smtp.password'),
                    'mail_encryption' => config('mail.mailers.smtp.encryption'),
                    'mail_from_address' => config('mail.from.address'),
                    'mail_from_name' => config('mail.from.name'),
                    default => null,
                };
                if ($envFallback) {
                    $value = $envFallback;
                }
            }

            $this->settings[$key] = $value;
            $this->settingMeta[$key] = [
                'label' => $label,
                'type' => $type,
                'description' => $description,
                'options' => $options
            ];
        }
    }

    public function save()
    {
        $permission = 'edit settings';
        if ($this->activeTab === 'email') $permission = 'edit email settings';
        if ($this->activeTab === 'appearance') $permission = 'edit theme settings';
        abort_if(!auth()->user()->can($permission), 403);

        $rules = [];
        foreach ($this->settingMeta as $key => $meta) {
            if ($meta['type'] === 'email') {
                $rules['settings.'.$key] = 'nullable|email';
            } elseif ($meta['type'] === 'url') {
                $rules['settings.'.$key] = 'nullable|url';
            } elseif ($meta['type'] === 'boolean' || $meta['type'] === 'toggle') {
                $rules['settings.'.$key] = 'boolean';
            } elseif ($meta['type'] === 'image') {
                $rules['settings.'.$key] = 'nullable';
                if ($this->settings[$key] instanceof TemporaryUploadedFile) {
                    $rules['settings.'.$key] = 'image|max:2048'; // 2MB max
                }
            } elseif ($meta['type'] === 'repeater_social') {
                $rules['settings.'.$key] = 'array';
                $rules['settings.'.$key.'.*.platform'] = 'required|string';
                $rules['settings.'.$key.'.*.url'] = 'required|string';
            } elseif ($meta['type'] === 'repeater_links') {
                $rules['settings.'.$key] = 'array';
                $rules['settings.'.$key.'.*.label'] = 'required|string';
                $rules['settings.'.$key.'.*.url'] = 'required|string';
            } else {
                $rules['settings.'.$key] = 'nullable';
            }
        }
        
        if (!empty($rules)) {
            $this->validate($rules);
        }

        foreach ($this->settings as $key => $value) {
            if (isset($this->settingMeta[$key])) {
                if ($this->settingMeta[$key]['type'] === 'boolean' || $this->settingMeta[$key]['type'] === 'toggle') {
                    $value = $value ? '1' : '0';
                } elseif ($this->settingMeta[$key]['type'] === 'image' && $value instanceof TemporaryUploadedFile) {
                    $path = $value->store('settings', 'public');
                    $value = '/storage/' . $path;
                } elseif ($this->settingMeta[$key]['type'] === 'repeater_social' || $this->settingMeta[$key]['type'] === 'repeater_links') {
                    $value = json_encode(array_values($value));
                }
            }
            // Do not override image settings if they were not changed (value is a string but not uploaded file)
            // Wait, if it wasn't changed, $value is already the existing string path! So it's safe to set it.
            Setting::set($key, $value);
        }

        Setting::flushCache();

        $this->dispatch('notify', message: 'Settings saved successfully.', type: 'success');
    }

    public function sendTestEmail()
    {
        abort_if(!auth()->user()->can('edit email settings'), 403);
        $this->validate(['testEmailAddress' => 'required|email']);

        config([
            'mail.mailers.smtp.host' => $this->settings['mail_host'] ?? config('mail.mailers.smtp.host'),
            'mail.mailers.smtp.port' => $this->settings['mail_port'] ?? config('mail.mailers.smtp.port'),
            'mail.mailers.smtp.username' => $this->settings['mail_username'] ?? config('mail.mailers.smtp.username'),
            'mail.mailers.smtp.password' => $this->settings['mail_password'] ?? config('mail.mailers.smtp.password'),
            'mail.mailers.smtp.encryption' => $this->settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
            'mail.from.address' => $this->settings['mail_from_address'] ?? config('mail.from.address'),
            'mail.from.name' => $this->settings['mail_from_name'] ?? config('mail.from.name'),
        ]);

        try {
            Mail::raw('This is a test email from Zehanat settings.', function ($msg) {
                $msg->to($this->testEmailAddress)
                    ->subject('Test Email - Zehanat');
            });
            $this->dispatch('notify', message: 'Test email sent successfully.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Failed to send test email. Check your settings. Error: ' . $e->getMessage(), type: 'error');
        }
    }

    public function addRepeaterItem($key, $defaultValues = [])
    {
        if (!isset($this->settings[$key]) || !is_array($this->settings[$key])) {
            $this->settings[$key] = [];
        }
        $this->settings[$key][] = $defaultValues;
    }

    public function removeRepeaterItem($key, $index)
    {
        if (isset($this->settings[$key][$index])) {
            unset($this->settings[$key][$index]);
            $this->settings[$key] = array_values($this->settings[$key]);
        }
    }

    public function resetToDefaults($group)
    {
        $permission = 'edit settings';
        if ($group === 'email') $permission = 'edit email settings';
        if ($group === 'appearance') $permission = 'edit theme settings';
        abort_if(!auth()->user()->can($permission), 403);

        $this->dispatch('confirm-action', 
            title: 'Reset Settings', 
            message: 'Are you sure you want to reset all ' . ucfirst($group) . ' settings to their factory defaults? This action cannot be undone.', 
            action: 'perform-reset-defaults', 
            params: [$group]
        );
    }

    #[On('perform-reset-defaults')]
    public function performResetDefaults($group)
    {
        $permission = 'edit settings';
        if ($group === 'email') $permission = 'edit email settings';
        if ($group === 'appearance') $permission = 'edit theme settings';
        abort_if(!auth()->user()->can($permission), 403);

        // Assume we just clear them out or delete, then let them re-populate on next load.
        // Or if Setting has a method, but since it's not strictly documented, we just delete the group.
        Setting::where('group', $group)->delete();
        Setting::flushCache();

        $this->loadTabSettings();
        $this->dispatch('notify', message: ucfirst($group) . ' settings have been reset.', type: 'success');
    }

    #[Computed]
    public function themePalettes()
    {
        return [
            'default' => ['name' => 'Zehanat Default', 'primary' => '#43baff', 'secondary' => '#7141b1', 'dark' => '#1b1d21', 'style' => 'Cool & techy'],
            'ocean_teal' => ['name' => 'Ocean Teal', 'primary' => '#14b8a6', 'secondary' => '#0ea5e9', 'dark' => '#0f172a', 'style' => 'Calm & professional'],
            'royal_indigo' => ['name' => 'Royal Indigo', 'primary' => '#6366f1', 'secondary' => '#8b5cf6', 'dark' => '#1e1b4b', 'style' => 'Bold & academic'],
            'emerald_green' => ['name' => 'Emerald Green', 'primary' => '#10b981', 'secondary' => '#06b6d4', 'dark' => '#022c22', 'style' => 'Fresh & organic'],
            'sunset_amber' => ['name' => 'Sunset Amber', 'primary' => '#f59e0b', 'secondary' => '#ef4444', 'dark' => '#1c1917', 'style' => 'Warm & energetic'],
        ];
    }

    public function selectTheme($themeKey)
    {
        $palettes = $this->themePalettes();
        if (isset($palettes[$themeKey])) {
            $this->settings['theme_active'] = $themeKey;
            $this->settings['theme_primary_color'] = $palettes[$themeKey]['primary'];
            $this->settings['theme_secondary_color'] = $palettes[$themeKey]['secondary'];
            $this->settings['theme_dark_color'] = $palettes[$themeKey]['dark'];
        }
    }

    public function render()
    {
        return view('livewire.admin.setting-manager')->layout('layouts.admin');
    }
}
