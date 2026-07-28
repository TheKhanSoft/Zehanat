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
    public function showModal(string $title, string $message, string $action, array $params = [])
    {
        $this->title = $title;
        $this->message = $message;
        $this->confirmAction = $action;
        $this->actionParams = $params;
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
