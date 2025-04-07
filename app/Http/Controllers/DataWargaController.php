<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Http\Requests\StoreDataWargaRequest;
use App\Http\Requests\UpdateDataWargaRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DataWarga::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('tempat_lahir', 'like', "%{$search}%")
                ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        }

        $title = 'Hapus Data Warga!';
        $text = "Apakah anda yakin menghapus data ini?";
        confirmDelete($title, $text);

        return view('pages.warga.index', [
            'title' => 'Data Warga',
            'dataWarga' => $query->paginate(10)->withQueryString(), // Maintain search in pagination
            'search' => $request->input('search') // Pass search query back to view
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.warga.form', [
            'title' => 'Tambah Data Warga',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'nik' => 'required|unique:data_wargas',
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        DataWarga::create($validatedata);

        Alert::success('Berhasil', 'Data Warga berhasil ditambahkan!');
        // Alert::toast('Data Warga berhasil ditambahkan!', 'success');
        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataWarga $dataWarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataWarga $warga)
    {
        return view('pages.warga.form', [
            'title' => 'Edit Data Warga',
            'data' => $warga
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataWarga $warga)
    {
        $validatedata = $request->validate([
            'nik' => 'required|unique:data_wargas,nik,' . $warga->id,
            'nama' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $warga->update($validatedata);
        Alert::success('Berhasil', 'Data Warga berhasil diupdate!');

        return redirect()->route('warga.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataWarga $warga)
    {
        $warga->delete();
        Alert::success('Berhasil', 'Data Warga berhasil dihapus!');

        return redirect()->route('warga.index');
    }

    public function cetak()
    {
        $dataWarga = DataWarga::all();
        $pdf = PDF::loadView('pages.warga.cetak', compact('dataWarga'));
        return $pdf->stream('data_warga.pdf');
    }
}
