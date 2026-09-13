<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kelayakan extends Model
{
    protected $table = 'tb_kelayakan';
    protected $primaryKey = 'id_kelayakan';
    public $timestamps = false;

    protected $fillable = [
    'id_user',
    'id_sektor',
    'id_penilaian_lahan',
    'id_presentasi_lahan',
    'hasil_kelayakan',
];

    public function user()
{
    return $this->belongsTo(
        User::class,
        'id_user',
        'id_user'
    );
}
    public function penilaianLahan()
    {

        return $this->belongsTo(PenilaianLahan::class,'id_penilaian_lahan', 'id_penilaian');
    }

    public function presentasi ()
    {
        return $this->belongsTo(Presentasi::class,'id_presentasi_lahan','id_presentasi');
    }
}
