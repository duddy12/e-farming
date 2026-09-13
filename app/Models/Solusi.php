<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $table = 'tb_solusi';
    protected $primaryKey = 'id_solusi';
    public $timestamps = false;


    protected $fillable = [
        'id_user',
        'kategori_solusi',
        'desc',
        'tgl_upload',

    ];

    public function user()
{
    return $this->belongsTo(
        User::class,
        'id_user',
        'id_user'
    );
}
}
