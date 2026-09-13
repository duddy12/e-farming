<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianLahan extends Model
{
    protected $table = 'tb_penilaian_lahan';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'Tingkat_Erosi',
        'Kondisi_Dreinase',
        'Tekstur_Tanah',
        'Kondisi_basah',
        'Kondisi_kering',
        'periode',

    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    public function kelayakan(){

        return $this->hasMany(
            Kelayakan::class,
            'id_penilaian_lahan',
            'id_penilaian'

        );
    }
}
