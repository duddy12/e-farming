<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class KategoriAdmin extends Model
{
    
    protected $table = 'tb_kategori_admin';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'hak_akses',
    ];

    public function admin()
    {
        return $this->hasMany(Admin::class, 'kategori', 'id_kategori');
    }
}
