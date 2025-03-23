<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Http\Requests\StoreBobotKriteriaRequest;
use App\Http\Requests\UpdateBobotKriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BobotKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.perhitungan-ahp.index', [
            'kriterias' => Kriteria::all(),
            'comparisons' => BobotKriteria::all()->keyBy(function ($item) {
                return $item->kriteria_id_1 . '-' . $item->kriteria_id_2;
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Delete existing comparisons before saving new ones (optional)
        BobotKriteria::truncate();

        foreach ($request->bobot as $kriteria1 => $comparisons) {
            foreach ($comparisons as $kriteria2 => $bobot) {
                BobotKriteria::create([
                    'kriteria_id_1' => $kriteria1,
                    'kriteria_id_2' => $kriteria2,
                    'bobot' => $bobot,
                ]);
            }
        }

        Alert::success('Berhasil', 'Bobot Kriteria Berhasil Disimpan!');
        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBobotKriteriaRequest $request, BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BobotKriteria $bobotKriteria)
    {
        //
    }
}
