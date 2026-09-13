<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentasi extends Model
{
    protected $table = 'tb_presentasi';
    protected $primaryKey = 'id_presentasi';
    public $timestamps = false;

    protected $fillable = [
        'bibit_tanaman',
        'siklus_pupuk',
        'presnet_cahaya',
        'siklus_pengairan',

    ];

    public function kelayakan()
    {
        return $this->hasMany(Kelayakan::class,'id_presentasi_lahan', 'id_presentasi');

    }
}
