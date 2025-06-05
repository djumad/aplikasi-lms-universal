<?php

namespace App\Livewire;

use App\Models\Materi;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Ujian;

class SiswaDashboard extends Component
{
    public $tugas;
    public $ujian;
    public $materi;

public function mount()
{
    $kelasUserIds = Auth::user()->kelas->pluck('id')->toArray();

    $this->tugas = \App\Models\Tugas::whereHas('kelas', function ($q) use ($kelasUserIds) {
        $q->whereIn('kelas.id', $kelasUserIds);
    })
    ->with('kelas')
    ->orderBy('created_at', 'desc')
    ->get();

    $this->ujian = Ujian::whereHas('kelas', function ($q) use ($kelasUserIds) {
        $q->whereIn('kelas.id', $kelasUserIds);
    })
    ->with('kelas')
    ->orderBy('created_at', 'desc')
    ->get();

    $this->materi = Materi::whereHas('kelas', function ($q) use ($kelasUserIds) {
        $q->whereIn('kelas.id', $kelasUserIds);
    })
    ->with('kelas')
    ->orderBy('created_at', 'desc')
    ->get();
}


    public function render()
    {
        return view('livewire.siswa-dashboard', [
            'tugas' => $this->tugas,
            'ujian' => $this->ujian,
        ]);
    }
}
