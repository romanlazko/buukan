<?php
namespace App\Livewire\Traits;

use Livewire\Attributes\On;

trait Modal 
{
    #[On('openModal')]
    public function openModal($modal, $params = [])
    {
        $className = "App\\Livewire\\{$modal}";
        if (!class_exists($className)) {
            $className = "App\\Livewire\\Event\\{$modal}";
        }

        $this->dispatch('close-all-modal');
        $this->dispatch('set-data', $params)->to($className);
        $this->dispatch('open-modal', $modal);
    }

    public function closeModal()
    {
        $this->dispatch('close-all-modal');
    }
}