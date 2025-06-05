<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalPilihanGanda extends Model
{
    protected $guarded = [];

    public function ujian(){
        return $this->belongsTo(Ujian::class , 'ujian_id' , 'id');
    }

    protected $casts = [
        'pertanyaan' => 'array',
        'opsi_a' => 'array',
        'opsi_b' => 'array',
        'opsi_c' => 'array',
        'opsi_d' => 'array',
    ];

}