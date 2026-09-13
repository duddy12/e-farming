<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriAdmin;
class Admin extends Model
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'name_admin',
        'kategori',
        'telepon',
        'username',
        'password',
        'level',
        'column',


    ];
    public function kategori(){
        return $this->belongsTo(KategoriAdmin::class,'kategori','id_kategori');
    }
    
    //

}
