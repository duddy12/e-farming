<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiklusEvidence extends Model
{
    protected $table = 'tb_siklus_evidence';

    protected $primaryKey = 'id_evidence';

    public $timestamps = false;

    protected $fillable = [
        'id_siklus',
        'id_user',
        'foto_evidence',
        'tanggal_diambil',
    ];

    public function siklus()
    {
        return $this->belongsTo(
            Siklus::class,
            'id_siklus',
            'id_siklus'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}