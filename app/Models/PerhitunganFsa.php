<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerhitunganFsa extends Model
{
    protected $table = 'tb_perhitungan_fsa';
    protected $primaryKey = 'id_perhitungan';

    protected $fillable = [
        'id_user',
        'id_komoditas_unggulan',
        'id_komoditas_pembanding',
        'jenis_sektor',
        'keuntungan_ei',
        'biaya_produksi_d0',
        'produksi_t0',
        'harga_minimal_hi',
        'periode',


    ];

    public function user(){
        return $this->belongsTo(
            User::class,'id_user','id_user'
        );
    }

    public function komoditasUnggulan(){

        return $this->belongsTo(
            Komoditas::class,
            'id_komoditas_unggulan',
            'id_komoditas'

        );
    }

    public function komoditasPembanding()
    {

        return $this->belongsTo(
                Komoditas::class,
                'id_komoditas_pembanding',
                'id_komoditas'
                
            );

       
    }

}
