<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $guarded = [];

    public function kelas(){
        return $this->belongsToMany(Kelas::class , 'ujian_kelas');
    }

    public function soalPilihanGanda(){
        return $this->hasMany(SoalPilihanGanda::class , 'ujian_id' , 'id');
    }
    public function soalEsai(){
        return $this->hasMany(SoalEsai::class , 'ujian_id' , 'id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id', 'id');
    }

    public function hasilPilihanGanda(){
        return $this->hasMany(HasilPilihanGanda::class , 'ujian_id' , 'id');
    }
    public function hasilEsai(){
        return $this->hasMany(HasilEsai::class , 'ujian_id' , 'id');
    }
    
}