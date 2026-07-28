<?php

namespace App\Services;

use App\Data\RenderedEmail;
use App\Enums\EmailTemplateKey;
use App\Models\EmailTemplate;
use App\Support\EmailTemplateDefaults;
use Illuminate\Support\HtmlString;

class EmailTemplateRenderer
{
    /**
     * @param  array<string, mixed>  $variables
     */
    public function render(EmailTemplateKey|string $key, array $variables = []): RenderedEmail
    {
        $key = $key instanceof EmailTemplateKey ? $key->value : $key;
        $template = EmailTemplate::query()->where('key', $key)->first();
        $definition = $template?->toArray() ?? EmailTemplateDefaults::get($key);

        if (! $definition) {
            throw new \InvalidArgumentException("Unknown email template [{$key}].");
        }

        $variables = [
            ...EmailTemplateDefaults::sampleData($key),
            ...$variables,
        ];

        $subject = trim(strip_tags($this->replace((string) $definition['subject'], $variables, false)));
        $preheader = trim(strip_tags($this->replace((string) ($definition['preheader'] ?? ''), $variables, false)));
        $bodyHtml = $this->replace((string) $definition['body_html'], $variables, true);
        $bodyText = trim((string) ($definition['body_text'] ?? ''));
        $bodyText = $bodyText !== ''
            ? $this->replace($bodyText, $variables, false)
            : $this->htmlToText($bodyHtml);

        $html = view('emails.managed-html', [
            'subject' => $subject,
            'preheader' => $preheader,
            'body' => new HtmlString($bodyHtml),
        ])->render();

        return new RenderedEmail($subject, $preheader, $html, $bodyText);
    }

    public function isActive(EmailTemplateKey|string $key): bool
    {
        $key = $key instanceof EmailTemplateKey ? $key->value : $key;
        $template = EmailTemplate::query()->where('key', $key)->first();

        return $template
            ? $template->is_active
            : (bool) (EmailTemplateDefaults::get($key)['is_active'] ?? false);
    }

    /**
     * @return array<int, string>
     */
    public function tokens(string ...$values): array
    {
        preg_match_all('/{{\s*([a-zA-Z0-9_.-]+)\s*}}/', implode("\n", $values), $matches);

        return array_values(array_unique($matches[1]));
    }

    /**
     * @param  array<string, mixed>  $variables
     */
    private function replace(string $content, array $variables, bool $escapeHtml): string
    {
        return (string) preg_replace_callback(
            '/{{\s*([a-zA-Z0-9_.-]+)\s*}}/',
            static function (array $match) use ($variables, $escapeHtml): string {
                $value = $variables[$match[1]] ?? '';
                $value = is_scalar($value) ? (string) $value : '';

                return $escapeHtml
                    ? htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
                    : $value;
            },
            $content,
        );
    }

    private function htmlToText(string $html): string
    {
        $html = preg_replace('/<\s*br\s*\/?>/i', "\n", $html) ?? $html;
        $html = preg_replace('/<\/(p|div|h[1-6]|li)>/i', "\n", $html) ?? $html;

        return trim(html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }
}
