<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;

class UjianDetail extends Component
{
    public Ujian $ujian;

    public function render()
    {
        return view('livewire.ujian-detail', [
            'ujian' => $this->ujian,
        ]);
    }
}
