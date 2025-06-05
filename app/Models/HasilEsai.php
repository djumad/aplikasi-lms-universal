<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilEsai extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function ujian(){
        return $this->belongsTo(Ujian::class , 'ujian_id' , 'id');
    }
    
    public function soalEsai(){
        return $this->belongsTo(SoalEsai::class , 'soal_id' , 'id');
    }
}
