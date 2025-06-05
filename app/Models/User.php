<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    public function kelas(){
        return $this->belongsToMany(Kelas::class , 'kelas_users');
    }
    public function ujian(){
        return $this->hasMany(Ujian::class , 'user_id' , 'id');
    }
    
    public function tugas(){
        return $this->hasMany(Tugas::class , 'user_id' , 'id');
    }

    public function hasilTugsSiswa(){
        return $this->hasMany(HasilTugasSiswa::class , 'user_id' , 'id');
    }
    
    public function hasilPilihanGanda(){
        return $this->hasMany(HasilPilihanGanda::class , 'user_id' , 'id');
    }
    public function hasilEsai(){
        return $this->hasMany(HasilEsai::class , 'user_id' , 'id');
    }

}
