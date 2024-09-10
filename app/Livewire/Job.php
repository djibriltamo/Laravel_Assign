<?php

namespace App\Livewire;


use App\Notifications\JobLiked;
use Livewire\Component;

class Job extends Component
{
    public $job;
    public $conversation;

    public function mount($job)
    {
        $this->job = $job;
    }

    public function addLike()
    {
        
        if ($this->isAuth()) 
        {
            $response = auth()->user()->likes()->toggle($this->job->id);

            if ($response['attached']) {
                $user = $this->job->user;
    
                if ($user) { // Vérifiez que l'utilisateur existe
                    $user->notify(new JobLiked($this->job));
                }
            }
        }else{
            //Emettre un évènement message flash

            $this->dispatch('flash-message', 'Veuillez-vous connecter pour ajouter une mission
             à vos favoris.', 'error');
        }

    }

    private function isAuth()
    {
        return auth()->check();
    }
    
    public function render()
    {
        return view('livewire.job', [
            'job' => $this->job
        ]);
    }
}
