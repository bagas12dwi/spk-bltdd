<?php

namespace App\Http\Controllers;

use App\Models\KriteriaWarga;
use App\Http\Requests\StoreKriteriaWargaRequest;
use App\Http\Requests\UpdateKriteriaWargaRequest;
use App\Models\DataWarga;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KriteriaWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Fetch all unique kriteria
        $kriteriaList = Kriteria::all();

        // Query for KriteriaWarga with necessary relationships
        $query = KriteriaWarga::with(['warga', 'kriteria', 'subkriteria']);

        // Apply search filter if it exists
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('warga', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Get all results without pagination
        $kriteriaWarga = $query->get();

        // Group data before pagination
        $groupedKriteriaWarga = $kriteriaWarga->groupBy(['batch', 'id_data_warga']);

        // Convert grouped data to a collection and paginate manually
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $pagedData = $groupedKriteriaWarga->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Create a new paginator instance
        $pagination = new LengthAwarePaginator(
            $pagedData,
            $groupedKriteriaWarga->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.kriteria-warga.index', [
            'kriteriaList' => $kriteriaList,
            'kriteriaWarga' => $pagedData, // Pass paginated grouped data
            'pagination' => $pagination, // Pass custom paginator
            'search' => $request->input('search')
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::with('subkriteria')->get();
        $dataWarga = DataWarga::all();
        return view('pages.kriteria-warga.form', [
            'kriterias' => $kriteria,
            'dataWarga' => $dataWarga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_data_warga' => 'required',
            'subkriteria' => 'required|array',
        ]);

        $batch = 0;
        $existData = KriteriaWarga::where('id_data_warga', $request->id_data_warga)
            ->latest()
            ->first();
        if ($existData->id_data_warga) {
            $batch = $existData->batch + 1;
        }

        foreach ($request->subkriteria as $id_kriteria => $id_subkriteria) {
            $subkriteriaData = Subkriteria::where('id', $id_subkriteria)->first();
            KriteriaWarga::create([
                'id_kriteria' => $subkriteriaData->id_kriteria,
                'id_subkriteria' => $id_subkriteria,
                'id_data_warga' => $request->id_data_warga,
                'nilai' => $subkriteriaData->bobot,
                'batch' => $batch
            ]);
        }

        return redirect()->route('kriteria-warga.index')->with('success', 'Data berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(KriteriaWarga $kriteriaWarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KriteriaWarga $kriteriaWarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKriteriaWargaRequest $request, KriteriaWarga $kriteriaWarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KriteriaWarga $kriteriaWarga)
    {
        //
    }
}
