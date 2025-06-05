<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTugasSiswa extends Model
{
    protected $guarded =[];

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function tugas(){
        return $this->belongsTo(Tugas::class , 'tugas_id', 'id');
    }
}
