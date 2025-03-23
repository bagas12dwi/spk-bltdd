<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria');
    }

    public function kriteria_warga()
    {
        return $this->hasMany(KriteriaWarga::class, 'id_kriteria');
    }
}
