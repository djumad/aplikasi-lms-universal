<?php

namespace App\Filament\Pages;

use App\Models\HasilPilihanGanda;
use App\Models\HasilTugasSiswa;
use App\Models\Kelas;
use App\Models\User;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class RekapNilaiSiswa extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.rekap-nilai-siswa';

    public static function canViewAny() : bool{
        return Auth::user()->role === "guru";
    }

    public $data = [];

    public function mount(): void
    {
        $this->data = $this->getRekapData();
    }

    protected function getRekapData()
    {
        $rekap = [];

        $kelasList = Kelas::with('user')->get();

        foreach ($kelasList as $kelas) {
            $siswaList = $kelas->user()->where('role', 'siswa')->get();

            foreach ($siswaList as $siswa) {
                $nilaiAkhir = $this->hitungNilaiAkhir($siswa, $kelas->id);

                $rekap[] = [
                    'kelas' => $kelas->nama,
                    'nama_siswa' => $siswa->name,
                    'nilai_tugas' => $this->hitungNilaiTugas($siswa, $kelas->id),
                    'nilai_uts' => $this->hitungNilaiUjian($siswa, $kelas->id, 'UTS'),
                    'nilai_uas' => $this->hitungNilaiUjian($siswa, $kelas->id, 'UAS'),
                    'nilai_akhir' => $nilaiAkhir,
                    'grade' => $this->konversiNilaiKeHuruf($nilaiAkhir),
                ];
            }
        }

        return $rekap;
    }

    protected function hitungNilaiTugas(User $siswa, $kelasId)
    {
        $nilai = HasilTugasSiswa::where('user_id', $siswa->id)
            ->whereHas('tugas.kelas', function ($query) use ($kelasId) {
                $query->where('kelas.id', $kelasId);
            })
            ->avg('nilai');

        return $nilai !== null ? round($nilai, 2) : 0;
    }

    protected function hitungNilaiUjian(User $siswa, $kelasId, $jenis)
    {
        $hasil = HasilPilihanGanda::where('user_id', $siswa->id)
            ->whereHas('ujian', function ($query) use ($kelasId, $jenis) {
                $query->where('jenis', $jenis)
                    ->whereHas('kelas', function ($subQuery) use ($kelasId) {
                        $subQuery->where('kelas.id', $kelasId);
                    });
            })
            ->get();

        if ($hasil->isEmpty()) {
            return 0;
        }

        return round($hasil->avg(fn($item) => $item->nilai_akhir), 2);
    }

    protected function hitungNilaiAkhir(User $siswa, $kelasId)
    {
        $nilaiTugas = $this->hitungNilaiTugas($siswa, $kelasId);
        $nilaiUTS = $this->hitungNilaiUjian($siswa, $kelasId, 'UTS');
        $nilaiUAS = $this->hitungNilaiUjian($siswa, $kelasId, 'UAS');

        return round(($nilaiTugas * 0.3) + ($nilaiUTS * 0.3) + ($nilaiUAS * 0.4), 2);
    }

    protected function konversiNilaiKeHuruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        if ($nilai >= 75) return 'B';
        if ($nilai >= 65) return 'C';
        if ($nilai >= 50) return 'D';
        return 'E';
    }
}