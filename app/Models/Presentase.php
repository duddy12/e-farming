<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentase extends Model
{
    protected $table = 'tb_presentase';
    protected $primaryKey = 'id_presentase';
    public $timestamps = false;

    protected $fillable = [
        'id_sektor',
        'desc',


    ];
}
