<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $guarded = [];

    public function kelas(){
        return $this->belongsToMany(Kelas::class , 'tugas_kelas');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function hasilTugasSiswa(){
        return $this->hasMany(HasilTugasSiswa::class , 'tugas_id' , 'id');
    }
}
