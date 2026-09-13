<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   
   use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
    'nama_user',
    'user_name',
    'password',
    'email',
    'role',
];

   

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }

    public function isSuperAdmin(){
    return $this->role === 'superadmin';
    }

    public function bukuTamu(){

        return $this->hasMany(BukuTamu::class,'id_user','id_user');
    }

    public function komentar(){
        return $this->hasMany(Komentar::class,'id_user','id_user');
    }

    public function perhitunganFsa()
    {
        return $this->hasMany(
            PerhitunganFsa::class,
            'id_user',
            'id_user'

        );

    }
}