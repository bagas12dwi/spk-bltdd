<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaWarga extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaWargaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function warga()
    {
        return $this->belongsTo(DataWarga::class, 'id_data_warga');
    }

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
