<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPilihanGanda extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id', 'id');
    }

    public function hasilEsais()
    {
        return $this->hasMany(HasilEsai::class, 'ujian_id', 'ujian_id')
            ->where('user_id', $this->user_id);
    }

    public function hasilEsai()
    {
        return $this->hasMany(HasilEsai::class, 'user_id', 'user_id')
            ->where('ujian_id', $this->ujian_id);
    }
    public function getNilaiEsaiAttribute()
    {
        return round($this->hasilEsais->avg('nilai') ?? 0, 2);
    }

    public function getNilaiAkhirAttribute()
    {
        $pg = $this->nilai ?? 0;
        $esai = $this->nilai_esai;
        return round(($pg + $esai) / 2, 2);
    }
}
