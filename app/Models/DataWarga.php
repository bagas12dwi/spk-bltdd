<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWarga extends Model
{
    /** @use HasFactory<\Database\Factories\DataWargaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function kriteria_warga()
    {
        return $this->hasMany(KriteriaWarga::class, 'id_data_warga');
    }
}
