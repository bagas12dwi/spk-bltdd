@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title')
        </div>
        <div class="container-form">
            <form action="{{ isset($data) ? route('kriteria.update', $data->id) : route('kriteria.store') }}" method="post">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kriteria :</label>
                    <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria"
                        value="{{ old('nama_kriteria', $data->nama_kriteria ?? '') }}" placeholder="Masukkan Nama" />
                </div>

                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
