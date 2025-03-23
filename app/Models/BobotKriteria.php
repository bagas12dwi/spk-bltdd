<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    /** @use HasFactory<\Database\Factories\BobotKriteriaFactory> */
    use HasFactory;
    protected $fillable = ['kriteria_id_1', 'kriteria_id_2', 'bobot'];

    public function kriteria1()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id_1');
    }

    public function kriteria2()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id_2');
    }
}
