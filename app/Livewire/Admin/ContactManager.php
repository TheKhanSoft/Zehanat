<?php

namespace App\Livewire\Admin;

use App\Models\ContactMessage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ContactManager extends Component
{
    use WithPagination;

    public function mount()
    {
        abort_if(!auth()->user()->can('view contacts'), 403);
    }

    public $search = '';
    public $status = 'all';
    
    public $messageId = null;
    public $name = '';
    public $email = '';
    public $subject = '';
    public $messageContent = '';
    public $is_read = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function viewMessage($id)
    {
        $msg = ContactMessage::findOrFail($id);
        
        if (!$msg->is_read) {
            $msg->update(['is_read' => true]);
        }

        $this->messageId = $msg->id;
        $this->name = $msg->name;
        $this->email = $msg->email;
        $this->subject = $msg->subject;
        $this->messageContent = $msg->message;
        $this->is_read = true;

        $this->dispatch('open-modal', id: 'viewContactModal');
    }

    public function toggleRead($id)
    {
        abort_if(!auth()->user()->can('edit contacts'), 403);

        $msg = ContactMessage::findOrFail($id);
        $msg->is_read = !$msg->is_read;
        $msg->save();
        
        $statusStr = $msg->is_read ? 'read' : 'unread';
        $this->dispatch('notify', message: "Message marked as {$statusStr}.", type: 'success');
    }

    public function confirmDelete($id)
    {
        abort_if(!auth()->user()->can('delete contacts'), 403);

        $this->dispatch('confirm-action', 
            title: 'Delete Message', 
            message: 'Are you sure you want to delete this message permanently?', 
            action: 'delete-contact', 
            params: [$id]
        );
    }

    #[On('delete-contact')]
    public function deleteContact($id)
    {
        abort_if(!auth()->user()->can('delete contacts'), 403);

        $msg = ContactMessage::findOrFail($id);
        $msg->delete();

        $this->dispatch('notify', message: 'Message deleted successfully.', type: 'success');
    }

    public function render()
    {
        $query = ContactMessage::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->status === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->status === 'read') {
            $query->where('is_read', true);
        }

        $messages = $query->latest()->paginate(15);
        
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::unread()->count();

        return view('livewire.admin.contact-manager', [
            'messages' => $messages,
            'totalMessages' => $totalMessages,
            'unreadMessages' => $unreadMessages,
        ])->layout('layouts.admin');
    }
}
