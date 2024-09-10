<?php

namespace App\Livewire;

use Livewire\Component;

class Flash extends Component
{

    public $styleByType = [
        'error' => 'border-red-700 text-red-700 bg-red-200',
        'success' => 'border-green-700 text-green-700 bg-green-200',
        'warning' => 'border-orange-700 text-orange-700 bg-orange-200',
        'info' => 'border-blue-700 text-blue-700 bg-blue-200'    
    ];
    public $message;
    public $type = 'success';
    protected $listeners = ['flash-message' => 'setFlashMessage'];

    public function setFlashMessage($message, $type)
    {
        $this->message = $message;
        $this->type = $type;

        $this->dispatch('flashMessage', ['message' => $this->message]);
    }

    public function render()
    {
        return view('livewire.flash');
    }
}
