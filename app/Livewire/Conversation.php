<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Conversation extends Component
{
    use AuthorizesRequests;

    public $conversation;
    public $job;
    public $message;
    protected $listeners = ['sent' => '$refresh']; 
    
    public function mount($conversation)
    {
        $this->conversation = $conversation;
        $this->job = $conversation->job;
        $this->authorize('view', [$this->job, $this->conversation]);
    }

    public function sendMessage()
    {
            Message::create([
                'user_id' => auth()->user()->id,
                'conversation_id' => $this->conversation->id,
                'content' => $this->message
            ]);
    
            $this->message='';
            $this->dispatch('sent');
    }

    public function render()
    {
        return view('livewire.conversation');
    }
   
}
