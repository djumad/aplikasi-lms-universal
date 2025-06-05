<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $guarded = [];

    public function kelas(){
        return $this->belongsToMany(Kelas::class , 'materi_kelas');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
