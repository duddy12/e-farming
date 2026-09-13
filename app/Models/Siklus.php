<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siklus extends Model
{
    protected $table = 'tb_siklus';

    protected $primaryKey = 'id_siklus';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_sektor',
        'periode',
        'desc',
        'foto_evidence',
        'tanggal_diambil',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
    public function evidences()
{
    return $this->hasMany(
        SiklusEvidence::class,
        'id_siklus',
        'id_siklus'
    );
}
}