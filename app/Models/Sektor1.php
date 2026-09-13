<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sektor1 extends Model
{
    protected $table = 'tb_sektor1';
    protected $primaryKey = 'id_sektor';
    public $timestamps = false;

    protected $fillable = [
        'nama_sektor',
        'desc',
    ];
}
