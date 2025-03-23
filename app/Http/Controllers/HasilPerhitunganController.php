<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HasilPerhitunganController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::all();

        // Fetch pairwise comparisons and format them in an associative array
        $comparisons = BobotKriteria::all()->keyBy(function ($item) {
            return $item->kriteria_id_1 . '-' . $item->kriteria_id_2;
        });
        $columnSums = [];

        // Compute column sums for normalization
        foreach ($kriterias as $col) {
            $sum = 0;
            foreach ($kriterias as $row) {
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
        foreach ($kriterias as $row) {
            $sum = 0;
            foreach ($kriterias as $col) {
                $key = $row->id . '-' . $col->id;
                $inverseKey = $col->id . '-' . $row->id;
                $pairwiseValue = $comparisons[$key]->bobot ?? (isset($comparisons[$inverseKey]) ? round(1 / $comparisons[$inverseKey]->bobot, 3) : 1);
                $normalizedValue = $pairwiseValue / $columnSums[$col->id];
                $sum += $normalizedValue;
            }
            $rowSums[$row->id] = $sum; // Store total sum for each row
        }

        // Compute Priority Vector (Normalized row sums)
        $numCriteria = count($kriterias);
        $priorityVector = [];
        foreach ($rowSums as $id => $sum) {
            $priorityVector[$id] = $sum / $numCriteria;
        }

        // Compute Weighted Sum Vector (WSV)
        $weightedSumVector = [];
        $lambdaSum = 0;
        foreach ($kriterias as $row) {
            $wsv = 0;
            foreach ($kriterias as $col) {
                $key = $row->id . '-' . $col->id;
                $inverseKey = $col->id . '-' . $row->id;
                $pairwiseValue = $comparisons[$key]->bobot ?? (isset($comparisons[$inverseKey]) ? round(1 / $comparisons[$inverseKey]->bobot, 3) : 1);
                $normalizedValue = $pairwiseValue / $columnSums[$col->id];
                $wsv += $pairwiseValue * $priorityVector[$col->id]; // Multiply by Priority Vector
            }
            $weightedSumVector[$row->id] = $wsv;
            $lambdaSum += $wsv / $priorityVector[$row->id];
        }
        // Calculate Lambda Max, CI, and CR
        $lambdaMax = $lambdaSum / $numCriteria;
        $CI = ($lambdaMax - $numCriteria) / ($numCriteria - 1);

        // Random Index (RI) table
        $RI_values = [0.00, 0.00, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $RI = $numCriteria <= 10 ? $RI_values[$numCriteria] : 1.49;

        $CR = $RI == 0 ? 0 : $CI / $RI;
        return view('pages.hasil-perhitungan.index', [
            'kriterias' => $kriterias,
            'comparisons' => $comparisons,
            'columnSums' => $columnSums,
            'rowSums' => $rowSums,
            'priorityVector' => $priorityVector,
            'weightedSumVector' => $weightedSumVector,
            'lambdaMax' => $lambdaMax,
            'CI' => $CI,
            'CR' => $CR
        ]);
    }
}
