<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalEsai extends Model
{
    protected $guarded = [];

    public function ujian(){
        return $this->belongsTo(Ujian::class , 'ujian_id' , 'id');
    }

    
}
