<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    protected $table = 'tb_komoditas';
    protected $primaryKey = 'id_komoditas';
    public $timestamps = false;

    protected $fillable = [
        'nama_komoditas',
        'kategori',
        'satuan_produksi',
        'keterangan',

    ];

    public function perhitunganSebagaiUnggulan(){

        return $this->hasMany(
            PerhitunganFsa::class, 'id_komoditas_unggulan', 'id_komoditas'

        );
    }

    public function perhitunganSebagaiPembanding(){

        return $this->hasMany(

            PerhitunganFsa::class, 'id_komoditas_pembanding', 'id_komoditas'
        );

    }
}
