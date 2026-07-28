<?php

namespace App\Livewire\Admin;

use App\Mail\ManagedTemplateMail;
use App\Models\EmailTemplate;
use App\Services\EmailTemplateRenderer;
use App\Support\AdminPermissions;
use App\Support\EmailTemplateDefaults;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class EmailTemplateManager extends Component
{
    use WithPagination;

    public string $search = '';

    public string $categoryFilter = 'all';

    public string $statusFilter = 'all';

    public int $perPage = 12;

    public bool $showEditor = false;

    public bool $showPreview = false;

    public bool $showTestModal = false;

    public ?int $templateId = null;

    public string $key = '';

    public string $name = '';

    public string $category = 'General';

    public string $description = '';

    public string $subject = '';

    public string $preheader = '';

    public string $bodyHtml = '';

    public string $bodyText = '';

    public bool $isActive = true;

    public bool $isSystem = false;

    public int $sortOrder = 0;

    /** @var array<int, string> */
    public array $availableVariables = [];

    public string $previewHtml = '';

    public string $previewName = '';

    public string $testTemplateName = '';

    /** @var array<int, array{name: string, email: string}> */
    public array $testRecipients = [];

    /**
     * Kept for compatibility with older integrations that called sendTest directly.
     */
    public string $testEmail = '';

    public function mount(): void
    {
        abort_unless(auth()->user()->can('view email templates'), 403);
        $this->testEmail = auth()->user()->email;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function create(): void
    {
        abort_unless(auth()->user()->can('create email templates'), 403);

        $this->resetEditor();
        $this->key = 'custom.';
        $this->showEditor = true;
    }

    public function edit(int $id): void
    {
        abort_unless(auth()->user()->can('edit email templates'), 403);

        $template = EmailTemplate::findOrFail($id);
        $this->fillEditor($template);
        $this->showEditor = true;
    }

    public function save(EmailTemplateRenderer $renderer): void
    {
        $editing = $this->templateId !== null;
        abort_unless(auth()->user()->can($editing ? 'edit email templates' : 'create email templates'), 403);

        $rules = [
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:60'],
            'description' => ['nullable', 'string', 'max:1000'],
            'subject' => ['required', 'string', 'max:255'],
            'preheader' => ['nullable', 'string', 'max:255'],
            'bodyHtml' => ['required', 'string', 'max:100000'],
            'bodyText' => ['nullable', 'string', 'max:100000'],
            'isActive' => ['boolean'],
            'sortOrder' => ['integer', 'min:0', 'max:65535'],
        ];
        if (! $editing) {
            $rules['key'] = [
                'required',
                'string',
                'max:120',
                'regex:/^custom\.[a-z0-9]+(?:[._-][a-z0-9]+)*$/',
                Rule::unique('email_templates', 'key'),
            ];
        }
        $this->validate($rules, [
            'key.regex' => 'Custom keys must start with custom. and contain lowercase letters, numbers, dots, underscores, or hyphens.',
        ]);

        $tokens = $renderer->tokens($this->subject, $this->preheader, $this->bodyHtml, $this->bodyText);
        $template = $editing ? EmailTemplate::findOrFail($this->templateId) : new EmailTemplate;
        $allowedVariables = $template->is_system
            ? (EmailTemplateDefaults::get($template->key)['variables'] ?? [])
            : $tokens;
        $unknownTokens = array_values(array_diff($tokens, $allowedVariables));

        if ($unknownTokens !== []) {
            $this->addError('bodyHtml', 'Unsupported variables: '.implode(', ', $unknownTokens).'.');

            return;
        }

        if (! $editing) {
            $template->key = $this->key;
            $template->is_system = false;
        }
        $template->fill([
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description ?: null,
            'subject' => $this->subject,
            'preheader' => $this->preheader ?: null,
            'body_html' => $this->bodyHtml,
            'body_text' => $this->bodyText ?: null,
            'variables' => $allowedVariables,
            'is_active' => $this->isActive,
            'sort_order' => $this->sortOrder,
            'updated_by' => auth()->id(),
        ]);
        $template->save();

        $this->showEditor = false;
        $this->dispatch('notify', message: $editing ? 'Email template updated.' : 'Custom email template created.', type: 'success');
        $this->resetEditor();
    }

    public function preview(int $id, EmailTemplateRenderer $renderer): void
    {
        abort_unless(auth()->user()->can('view email templates'), 403);

        $template = EmailTemplate::findOrFail($id);
        $this->templateId = $template->id;
        $this->previewName = $template->name;
        $this->previewHtml = $renderer->render($template->key, EmailTemplateDefaults::sampleData($template->key))->html;
        $this->showPreview = true;
    }

    public function openTestModal(int $id): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::EMAIL_TEMPLATE_SEND_TEST), 403);

        $template = EmailTemplate::findOrFail($id);
        $this->templateId = $template->id;
        $this->testTemplateName = $template->name;
        $this->testRecipients = [[
            'name' => (string) auth()->user()->name,
            'email' => (string) auth()->user()->email,
        ]];
        $this->testEmail = (string) auth()->user()->email;
        $this->resetValidation();
        $this->showTestModal = true;
    }

    public function addTestRecipient(): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::EMAIL_TEMPLATE_SEND_TEST), 403);

        if (count($this->testRecipients) >= 10) {
            $this->addError('testRecipients', 'You can send a test to a maximum of 10 recipients at once.');

            return;
        }

        $this->testRecipients[] = ['name' => '', 'email' => ''];
        $this->resetValidation('testRecipients');
    }

    public function removeTestRecipient(int $index): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::EMAIL_TEMPLATE_SEND_TEST), 403);

        if (! array_key_exists($index, $this->testRecipients)) {
            return;
        }

        unset($this->testRecipients[$index]);
        $this->testRecipients = array_values($this->testRecipients);

        if ($this->testRecipients === []) {
            $this->testRecipients[] = ['name' => '', 'email' => ''];
        }

        $this->resetValidation();
    }

    public function sendTestEmails(): void
    {
        abort_unless(auth()->user()->can(AdminPermissions::EMAIL_TEMPLATE_SEND_TEST), 403);

        $validated = $this->validate([
            'testRecipients' => ['required', 'array', 'min:1', 'max:10'],
            'testRecipients.*.name' => ['nullable', 'string', 'max:120'],
            'testRecipients.*.email' => ['required', 'email', 'distinct:ignore_case', 'max:255'],
        ], [
            'testRecipients.*.email.required' => 'Enter an email address for this recipient.',
            'testRecipients.*.email.email' => 'Enter a valid email address.',
            'testRecipients.*.email.distinct' => 'Each test recipient must have a different email address.',
        ]);

        $template = EmailTemplate::findOrFail($this->templateId);
        $recipients = $validated['testRecipients'];

        foreach ($recipients as $recipient) {
            $name = trim((string) ($recipient['name'] ?? ''));
            $email = trim($recipient['email']);
            $variables = array_merge(
                EmailTemplateDefaults::sampleData($template->key),
                [
                    'recipient_name' => $name !== '' ? $name : 'Test recipient',
                    'recipient_email' => $email,
                ],
            );

            Mail::to($email, $name !== '' ? $name : null)->send(new ManagedTemplateMail(
                $template->key,
                $variables,
            ));
        }

        $count = count($recipients);
        $this->showTestModal = false;
        $this->testRecipients = [];
        $this->testTemplateName = '';
        $this->dispatch(
            'notify',
            message: $count === 1 ? 'Test email sent successfully.' : "{$count} test emails sent successfully.",
            type: 'success',
        );
    }

    public function sendTest(): void
    {
        if ($this->testEmail !== '') {
            $this->testRecipients = [[
                'name' => '',
                'email' => $this->testEmail,
            ]];
        }

        $this->sendTestEmails();
    }

    public function toggleActive(int $id): void
    {
        abort_unless(auth()->user()->can('edit email templates'), 403);

        $template = EmailTemplate::findOrFail($id);
        $template->update([
            'is_active' => ! $template->is_active,
            'updated_by' => auth()->id(),
        ]);

        $this->dispatch(
            'notify',
            message: $template->is_active ? 'Email template activated.' : 'Email template paused.',
            type: $template->is_active ? 'success' : 'info',
        );
    }

    public function confirmReset(int $id): void
    {
        abort_unless(auth()->user()->can('edit email templates'), 403);
        $template = EmailTemplate::findOrFail($id);
        abort_unless($template->is_system && EmailTemplateDefaults::get($template->key), 422);

        $this->dispatch(
            'confirm-action',
            title: 'Restore Template Defaults',
            message: "Replace all edited content in {$template->name} with the original system version?",
            action: 'reset-email-template',
            params: [$template->id],
        );
    }

    #[On('reset-email-template')]
    public function resetToDefault(int $id): void
    {
        abort_unless(auth()->user()->can('edit email templates'), 403);

        $template = EmailTemplate::findOrFail($id);
        $definition = EmailTemplateDefaults::get($template->key);
        abort_unless($template->is_system && $definition, 422);

        $template->update([
            'name' => $definition['name'],
            'category' => $definition['category'],
            'description' => $definition['description'],
            'subject' => $definition['subject'],
            'preheader' => $definition['preheader'],
            'body_html' => $definition['body_html'],
            'body_text' => $definition['body_text'],
            'variables' => $definition['variables'],
            'is_active' => $definition['is_active'],
            'sort_order' => $definition['sort_order'],
            'updated_by' => auth()->id(),
        ]);

        $this->dispatch('notify', message: 'System template defaults restored.', type: 'success');
    }

    public function confirmDelete(int $id): void
    {
        abort_unless(auth()->user()->can('delete email templates'), 403);
        $template = EmailTemplate::findOrFail($id);
        abort_if($template->is_system, 422, 'System email templates cannot be deleted.');

        $this->dispatch(
            'confirm-action',
            title: 'Delete Custom Template',
            message: "Permanently delete {$template->name}? Any custom code using its key will no longer be able to render it.",
            action: 'delete-email-template',
            params: [$template->id],
        );
    }

    #[On('delete-email-template')]
    public function deleteTemplate(int $id): void
    {
        abort_unless(auth()->user()->can('delete email templates'), 403);
        $template = EmailTemplate::findOrFail($id);
        abort_if($template->is_system, 422);
        $template->delete();

        $this->dispatch('notify', message: 'Custom email template deleted.', type: 'success');
    }

    public function closeEditor(): void
    {
        $this->showEditor = false;
        $this->resetEditor();
    }

    public function closePreview(): void
    {
        $this->showPreview = false;
        $this->previewHtml = '';
        $this->previewName = '';
        if (! $this->showTestModal) {
            $this->templateId = null;
        }
        $this->resetValidation();
    }

    public function closeTestModal(): void
    {
        $this->showTestModal = false;
        $this->testRecipients = [];
        $this->testTemplateName = '';
        if (! $this->showPreview) {
            $this->templateId = null;
        }
        $this->resetValidation();
    }

    public function render(): View
    {
        abort_unless(auth()->user()->can('view email templates'), 403);

        $query = EmailTemplate::query()
            ->with('updatedBy:id,name')
            ->when($this->search !== '', function ($query): void {
                $query->where(function ($query): void {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('key', 'like', "%{$this->search}%")
                        ->orWhere('subject', 'like', "%{$this->search}%");
                });
            })
            ->when($this->categoryFilter !== 'all', fn ($query) => $query->where('category', $this->categoryFilter))
            ->when($this->statusFilter === 'active', fn ($query) => $query->where('is_active', true))
            ->when($this->statusFilter === 'paused', fn ($query) => $query->where('is_active', false));

        return view('livewire.admin.email-template-manager', [
            'templates' => (clone $query)
                ->orderBy('sort_order')
                ->orderBy('category')
                ->orderBy('name')
                ->paginate($this->perPage),
            'categories' => EmailTemplate::query()->distinct()->orderBy('category')->pluck('category'),
            'stats' => [
                'total' => EmailTemplate::count(),
                'active' => EmailTemplate::where('is_active', true)->count(),
                'system' => EmailTemplate::where('is_system', true)->count(),
                'custom' => EmailTemplate::where('is_system', false)->count(),
            ],
        ])->layout('layouts.admin');
    }

    private function fillEditor(EmailTemplate $template): void
    {
        $this->resetValidation();
        $this->templateId = $template->id;
        $this->key = $template->key;
        $this->name = $template->name;
        $this->category = $template->category;
        $this->description = $template->description ?? '';
        $this->subject = $template->subject;
        $this->preheader = $template->preheader ?? '';
        $this->bodyHtml = $template->body_html;
        $this->bodyText = $template->body_text ?? '';
        $this->isActive = $template->is_active;
        $this->isSystem = $template->is_system;
        $this->sortOrder = $template->sort_order;
        $this->availableVariables = $template->variables ?? [];
    }

    private function resetEditor(): void
    {
        $this->resetValidation();
        $this->reset([
            'templateId',
            'key',
            'name',
            'description',
            'subject',
            'preheader',
            'bodyHtml',
            'bodyText',
            'isSystem',
            'sortOrder',
            'availableVariables',
        ]);
        $this->category = 'General';
        $this->isActive = true;
    }
}
