<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsToMany(User::class, 'kelas_users');
    }

    public function tugas(){
        return $this->belongsToMany(Tugas::class , 'tugas_kelas');
    }

    public function ujian(){
        return $this->belongsToMany(Ujian::class , 'ujian_kelas');
    }
}
