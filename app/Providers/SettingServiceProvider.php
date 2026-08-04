<?php

namespace App\Providers;

use App\Services\SettingService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once __DIR__ . '/../helpers.php';
        $this->app->singleton(SettingService::class, function () {
            return new SettingService();
        });
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            $emailSettings = $this->app->make(SettingService::class)->getGroup('email');

            if (!empty($emailSettings)) {
                if (!empty($emailSettings['mail_driver'])) {
                    Config::set('mail.default', $emailSettings['mail_driver']);
                }
                
                if (!empty($emailSettings['mail_host'])) {
                    Config::set('mail.mailers.smtp.host', $emailSettings['mail_host']);
                }

                if (!empty($emailSettings['mail_port'])) {
                    Config::set('mail.mailers.smtp.port', $emailSettings['mail_port']);
                }

                if (!empty($emailSettings['mail_username'])) {
                    Config::set('mail.mailers.smtp.username', $emailSettings['mail_username']);
                }

                if (!empty($emailSettings['mail_password'])) {
                    Config::set('mail.mailers.smtp.password', $emailSettings['mail_password']);
                }

                if (!empty($emailSettings['mail_encryption'])) {
                    Config::set('mail.mailers.smtp.encryption', $emailSettings['mail_encryption']);
                }

                if (!empty($emailSettings['mail_from_address'])) {
                    Config::set('mail.from.address', $emailSettings['mail_from_address']);
                }

                if (!empty($emailSettings['mail_from_name'])) {
                    Config::set('mail.from.name', $emailSettings['mail_from_name']);
                }
            }
        }

        Blade::directive('setting', function ($expression) {
            return "<?php echo \App\Models\Setting::get({$expression}); ?>";
        });
    }
}



