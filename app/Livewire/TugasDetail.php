<?php

namespace App\Livewire;

use App\Models\HasilTugasSiswa;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class TugasDetail extends Component
{
    use WithFileUploads;

    public Tugas $tugas;
    public $file_tugas;
    public $hasilTugas;

    public function mount()
    {
        $this->hasilTugas = HasilTugasSiswa::where('user_id', Auth::id())
            ->where('tugas_id', $this->tugas->id)
            ->first();
    }

    public function submit()
    {
        $this->validate([
            'file_tugas' => ['required', 'file', 'max:10240'],
        ]);

        if (now()->gt($this->tugas->deadline)) {
            session()->flash('success', 'Tugas berhasil dikumpulkan (Terlambat)');
        } else {
            session()->flash('success', 'Tugas berhasil dikumpulkan');
        }

        $path = $this->file_tugas->store('tugas_siswa', 'public');

        $this->hasilTugas = HasilTugasSiswa::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tugas_id' => $this->tugas->id,
            ],
            [
                'file_tugas' => $path,
            ]
        );

        $this->reset('file_tugas');
    }


    public function render()
    {
        return view('livewire.tugas-detail');
    }
}
