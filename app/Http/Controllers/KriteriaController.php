<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kriteria::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_kriteria', 'like', "%{$search}%");
        }
        $title = 'Hapus Kriteria!';
        $text = "Apakah anda yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.kriteria.index', [
            'title' => 'Kriteria',
            'data' => $query->paginate(10)->withQueryString(),
            'search' => $request->input('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kriteria.form', [
            'title' => 'Tambah Kriteria'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kriteria' => 'required'
        ]);
        Kriteria::create($validatedData);
        Alert::success('Berhasil', 'Kriteria berhasil ditambahkan!');
        return redirect()->route('kriteria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriterium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriterium)
    {
        return view('pages.kriteria.form', [
            'title' => 'Edit Kriteria',
            'data' => $kriterium
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriterium)
    {
        $validatedData = $request->validate([
            'nama_kriteria' => 'required'
        ]);

        $kriterium->update($validatedData);

        Alert::success('Berhasil', 'Kriteria berhasil diupdate!');
        return redirect()->route('kriteria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();

        Alert::success('Berhasil', 'Kriteria berhasil diupdate!');
        return redirect()->route('kriteria.index');
    }
}
