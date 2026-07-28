<?php

namespace App\Livewire\Admin\Ui;

use Livewire\Component;
use Livewire\Attributes\On;

class ToastNotification extends Component
{
    public array $notifications = [];

    #[On('notify')]
    public function addNotification(string $message, string $type = 'success')
    {
        $id = uniqid();
        $this->notifications[] = [
            'id' => $id,
            'message' => $message,
            'type' => $type,
        ];
    }

    public function removeNotification($id)
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $id);
    }

    public function render()
    {
        return view('livewire.admin.ui.toast-notification');
    }
}
