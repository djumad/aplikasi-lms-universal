<?php

namespace App\Livewire;

use App\Models\Ujian;
use App\Models\HasilEsai;
use App\Models\HasilPilihanGanda;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UjianMulai extends Component
{
    public $ujian;
    public $jawabanPg = [];
    public $jawabanEsai = [];

    public function mount($ujian)
    {
        $this->ujian = Ujian::with(['soalPilihanGanda', 'soalEsai'])->findOrFail($ujian);
    }

    public function simpanJawaban()
    {
        $userId = Auth::id();

        // Cek apakah user sudah mengerjakan ujian ini
        $sudahAda = HasilPilihanGanda::where('user_id', $userId)
            ->where('ujian_id', $this->ujian->id)
            ->exists();

        if ($sudahAda) {
            session()->flash('message', 'Anda sudah mengerjakan ujian ini.');
            return;
        }

        // Hitung nilai pilihan ganda
        $nilaiMaksimalTotal = 0;
        $nilaiUser = 0;

        foreach ($this->ujian->soalPilihanGanda as $soal) {
            $nilaiMaksSoal = 0;
            foreach (['a', 'b', 'c', 'd'] as $opsi) {
                $nilaiOpsi = $soal->{'opsi_' . $opsi}['nilai'] ?? 0;
                if ($nilaiOpsi > $nilaiMaksSoal) {
                    $nilaiMaksSoal = $nilaiOpsi;
                }
            }
            $nilaiMaksimalTotal += $nilaiMaksSoal;

            $jawabanUser = $this->jawabanPg[$soal->id] ?? null;
            if ($jawabanUser !== null) {
                $nilaiUser += floatval($jawabanUser);
            }
        }

        $nilaiAkhir = $nilaiMaksimalTotal > 0 ? round(($nilaiUser / $nilaiMaksimalTotal) * 100) : 0;

        // Simpan hasil pilihan ganda
        HasilPilihanGanda::create([
            'user_id' => $userId,
            'ujian_id' => $this->ujian->id,
            'nilai' => $nilaiAkhir,
        ]);

        foreach ($this->ujian->soalEsai as $soal) {
            $jawaban = $this->jawabanEsai[$soal->id] ?? null;
            if ($jawaban) {
                HasilEsai::create([
                    'user_id' => $userId,
                    'ujian_id' => $this->ujian->id,
                    'soal_esai_id' => $soal->id,
                    'jawaban' => $jawaban,
                    'nilai' => null,
                ]);
            }
        }

        session()->flash('message', "Jawaban Anda berhasil disimpan. Nilai pilihan ganda: $nilaiAkhir. Jawaban esai akan dikoreksi.");
    }

    public function render()
    {
        return view('livewire.ujian-mulai');
    }
}
