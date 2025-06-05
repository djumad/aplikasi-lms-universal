<?php

namespace App\Livewire;

use App\Models\Materi;
use Livewire\Component;

class MateriDetail extends Component
{

    public Materi $materi;
    public function render()
    {
        return view('livewire.materi-detail' , [
            'materi' => $this->materi
        ]);
    }
}
