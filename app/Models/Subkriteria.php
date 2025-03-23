<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    /** @use HasFactory<\Database\Factories\SubkriteriaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    public function kriteria_warga()
    {
        return $this->hasMany(KriteriaWarga::class, 'id_subkriteria');
    }
}
