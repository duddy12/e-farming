<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'tb_komentar';
    protected $primaryKey = 'id_komentar';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'date_komentar',
        'username',
        'email'

    ];
    public function user(){

        return $this->belongsTo(User::class, 'id_user','id_user');
    }
}
