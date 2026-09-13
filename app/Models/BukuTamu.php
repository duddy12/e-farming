<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'tb_bukutamu';
    protected $primaryKey = 'id_bukutamu';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nama_tamu',
        'email',
        'pesan'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user','id_user');
    }
}
