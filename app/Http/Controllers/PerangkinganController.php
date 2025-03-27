<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Models\Kriteria;
use App\Models\KriteriaWarga;
use Illuminate\Http\Request;

class PerangkinganController extends Controller
{
    public function index(Request $request)
    {
        $kriteriaList = Kriteria::all();

        $kriteriaWargaQuery = KriteriaWarga::with(['warga', 'kriteria', 'subkriteria']);

        // Apply search before fetching data
        if ($request->has('search')) {
            $search = $request->input('search');
            $kriteriaWargaQuery->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Fetch filtered data and group it
        $kriteriaWarga = $kriteriaWargaQuery->get()->groupBy(['batch', 'id_data_warga']);

        // Fetch pairwise comparisons and format them in an associative array
        $comparisons = BobotKriteria::all()->keyBy(function ($item) {
            return $item->kriteria_id_1 . '-' . $item->kriteria_id_2;
        });

        $columnSums = [];

        // Compute column sums for normalization
        foreach ($kriteriaList as $col) {
            $sum = 0;
            foreach ($kriteriaList as $row) {
                $key = $row->id . '-' . $col->id;
                $inverseKey = $col->id . '-' . $row->id;

                if ($row->id == $col->id) {
                    $value = 1;
                } else {
                    $value = $comparisons[$key]->bobot ?? (isset($comparisons[$inverseKey]) ? round(1 / $comparisons[$inverseKey]->bobot, 3) : 1);
                }

                $sum += $value;
            }
            $columnSums[$col->id] = $sum;
        }

        $rowSums = [];
        foreach ($kriteriaList as $row) {
            $sum = 0;
            foreach ($kriteriaList as $col) {
                $key = $row->id . '-' . $col->id;
                $inverseKey = $col->id . '-' . $row->id;
                $pairwiseValue = $comparisons[$key]->bobot ?? (isset($comparisons[$inverseKey]) ? round(1 / $comparisons[$inverseKey]->bobot, 3) : 1);
                $normalizedValue = $pairwiseValue / $columnSums[$col->id];
                $sum += $normalizedValue;
            }
            $rowSums[$row->id] = $sum; // Store total sum for each row
        }

        return view('pages.perangkingan.index', [
            'kriteriaList' => $kriteriaList,
            'kriteriaWarga' => $kriteriaWarga,
            'rowSums' => $rowSums,
            'countKriteria' => $kriteriaList->count(),
            'search' => $request->input('search')
        ]);
    }
}
