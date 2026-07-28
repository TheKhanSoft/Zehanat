<?php

namespace App\Livewire\Admin;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class FaqManager extends Component
{
    use WithPagination;

    public function mount()
    {
        abort_if(!auth()->user()->can('view faqs'), 403);
    }

    public $search = '';
    public $status = 'all';

    public $faqId = null;
    public $question = '';
    public $answer = '';
    public $sort_order = 0;
    public $is_active = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function rules()
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function create()
    {
        abort_if(!auth()->user()->can('create faqs'), 403);

        $this->reset(['faqId', 'question', 'answer', 'sort_order', 'is_active']);
        $this->is_active = true;
        $this->sort_order = 0;
        
        $this->dispatch('open-modal', id: 'faqModal');
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->can('edit faqs'), 403);

        $faq = Faq::findOrFail($id);
        
        $this->faqId = $faq->id;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->sort_order = $faq->sort_order;
        $this->is_active = (bool) $faq->is_active;

        $this->dispatch('open-modal', id: 'faqModal');
    }

    public function save()
    {
        abort_if(!auth()->user()->can($this->faqId ? 'edit faqs' : 'create faqs'), 403);

        $validated = $this->validate();
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $this->is_active;

        if ($this->faqId) {
            $faq = Faq::findOrFail($this->faqId);
            $faq->update($validated);
            $message = 'FAQ updated successfully.';
        } else {
            Faq::create($validated);
            $message = 'FAQ created successfully.';
        }

        $this->dispatch('close-modal', id: 'faqModal');
        $this->dispatch('notify', message: $message, type: 'success');
        $this->reset(['faqId', 'question', 'answer', 'sort_order', 'is_active']);
    }

    public function toggleStatus($id)
    {
        abort_if(!auth()->user()->can('edit faqs'), 403);

        $faq = Faq::findOrFail($id);
        $faq->is_active = !$faq->is_active;
        $faq->save();

        $this->dispatch('notify', message: 'FAQ status updated successfully.', type: 'success');
    }

    public function confirmDelete($id)
    {
        abort_if(!auth()->user()->can('delete faqs'), 403);

        $this->dispatch('confirm-action', 
            title: 'Delete FAQ', 
            message: 'Are you sure you want to delete this FAQ permanently? This action cannot be undone.', 
            action: 'delete-faq', 
            params: [$id]
        );
    }

    #[On('delete-faq')]
    public function deleteFaq($id)
    {
        abort_if(!auth()->user()->can('delete faqs'), 403);

        $faq = Faq::findOrFail($id);
        $faq->delete();

        $this->dispatch('notify', message: 'FAQ deleted successfully.', type: 'success');
    }

    public function render()
    {
        $query = Faq::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('question', 'like', '%' . $this->search . '%')
                  ->orWhere('answer', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status !== 'all') {
            $query->where('is_active', $this->status === 'active');
        }

        $faqs = $query->orderBy('sort_order')->paginate(15);
        
        $totalFaqs = Faq::count();
        $activeFaqs = Faq::where('is_active', true)->count();
        $inactiveFaqs = $totalFaqs - $activeFaqs;

        return view('livewire.admin.faq-manager', [
            'faqs' => $faqs,
            'totalFaqs' => $totalFaqs,
            'activeFaqs' => $activeFaqs,
            'inactiveFaqs' => $inactiveFaqs,
        ])->layout('layouts.admin');
    }
}
