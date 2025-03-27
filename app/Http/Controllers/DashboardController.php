<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countWarga = DataWarga::count();
        $countKriteria = Kriteria::count();
        $countSubkriteria = Subkriteria::count();
        return view('welcome', compact(['countWarga', 'countKriteria', 'countSubkriteria']));
    }
}
