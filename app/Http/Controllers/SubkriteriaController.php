<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Http\Requests\StoreSubkriteriaRequest;
use App\Http\Requests\UpdateSubkriteriaRequest;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subkriteria::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_subkriteria', 'like', "%{$search}%");
        }
        $title = 'Hapus Subkriteria';
        $text = 'Apakah anda yakin menghapus data ini?';
        confirmDelete($title, $text);
        return view('pages.subkriteria.index', [
            'title' => 'Subkriteria',
            'data' => $query->with('kriteria')->paginate(10)->withQueryString(),
            'search' => $request->input('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('pages.subkriteria.form', [
            'title' => 'Tambah Subkriteria',
            'kriterias' => $kriteria,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_subkriteria' => 'required',
            'id_kriteria' => 'required',
            'bobot' => 'required'
        ]);

        Subkriteria::create($validatedData);
        Alert::success('Berhasil', 'Subkriteria berhasil ditambahkan!');
        return redirect()->route('subkriteria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subkriteria $subkriterium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subkriteria $subkriterium)
    {
        return view('pages.subkriteria.form', [
            'title' => 'Edit Kriteria',
            'data' => $subkriterium,
            'kriterias' => Kriteria::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subkriteria $subkriterium)
    {
        $validatedData = $request->validate([
            'nama_subkriteria' => 'required',
            'id_kriteria' => 'required',
            'bobot' => 'required'
        ]);

        $subkriterium->update($validatedData);

        Alert::success('Berhasil', 'Subkriteria berhasil diupdate!');
        return redirect()->route('subkriteria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subkriteria $subkriterium)
    {
        $subkriterium->delete();

        Alert::success('Berhasil', 'Subkriteria berhasil dihapus!');
        return redirect()->route('subkriteria.index');
    }
}
