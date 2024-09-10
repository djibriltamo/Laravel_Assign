<?php

namespace App\Livewire;

use App\Models\Job;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $jobs = [];
    public $selectIndex = 0;


    //Fonction pour naviguer entre les missions affichées sur la barre de recherche en partant du bas
    public function incrementIndex()
    {
        if ($this->selectIndex === count($this->jobs) - 1) {
            $this->selectIndex = 0;
        } else {
            $this->selectIndex++;
        }
    }

    //Fonction pour naviguer entre les missions affichées sur la barre de recherche en partant du haut
    public function decrementIndex()
    {
        if ($this->selectIndex === 0) {
            $this->selectIndex = count($this->jobs) - 1;
        } else {
            $this->selectIndex--;
        }
    }

    //Afficher le résultat de recherche lorsqu'on appuie sur entrer
    public function showJob()
    {
        if ($this->jobs)
        {
            return redirect()->route('jobs.show', [$this->jobs[$this->selectIndex]['id']]);
        }
    }
    
    //Fonction pour annuler la recherche
    public function resetIndex()
    {
        $this->reset('selectIndex');
    }

    //Fonction pour la recherche des missions
    public function updatedSearch()
    {
        $this->resetIndex();

        $words = '%' . $this->search . '%';

        if ($this->search)
        {
            $this->jobs = Job::where('title', 'like', $words)
                ->orWhere('description', 'like', $words)
                ->get();    

        }
    }

    public function render()
    {
        return view('livewire.search');
    }
}
