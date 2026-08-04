<?php

namespace App\Livewire\Admin\Ui;

use Livewire\Component;
use Livewire\Attributes\On;

class ConfirmationModal extends Component
{
    public bool $show = false;
    public string $title = 'Confirm Action';
    public string $message = 'Are you sure you want to proceed?';
    public string $confirmAction = '';
    public array $actionParams = [];

    #[On('confirm-action')]
    public function showModal($title = 'Confirm Action', $message = 'Are you sure?', $action = '', $params = [])
    {
        // Handle if JS sends a single object payload
        if (is_array($title) && isset($title['title'])) {
            $this->message = $title['message'] ?? $message;
            $this->confirmAction = $title['action'] ?? $action;
            $this->actionParams = $title['params'] ?? [];
            $this->title = $title['title'];
        } else {
            $this->title = $title;
            $this->message = $message;
            $this->confirmAction = $action;
            $this->actionParams = is_array($params) ? $params : [$params];
        }
        $this->show = true;
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function confirm()
    {
        if ($this->confirmAction) {
            $this->dispatch($this->confirmAction, ...$this->actionParams);
        }
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.admin.ui.confirmation-modal');
    }
}
