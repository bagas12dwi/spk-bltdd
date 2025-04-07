@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title')
        </div>
        <div class="container-form">
            <form action="{{ isset($data) ? route('subkriteria.update', $data->id) : route('subkriteria.store') }}"
                method="post">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama_subkriteria" class="form-label">Nama subkriteria :</label>
                    <input type="text" class="form-control" name="nama_subkriteria" id="nama_subkriteria"
                        value="{{ old('nama_subkriteria', $data->nama_subkriteria ?? '') }}" placeholder="Masukkan Nama" />
                </div>

                <div class="mb-3">
                    <label for="id_kriteria" class="form-label">Nama Kriteria</label>
                    <select class="form-select" name="id_kriteria" id="id_kriteria">
                        <option disabled selected>Select Kriteria</option>
                        @foreach ($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}"
                                {{ old('id_kriteria', $data->id_kriteria ?? '') == $kriteria->id ? 'selected' : '' }}>
                                {{ $kriteria->nama_kriteria }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot :</label>
                    <input type="number" class="form-control" name="bobot" id="bobot"
                        value="{{ old('bobot', $data->bobot ?? '') }}" placeholder="Masukkan Bobot" />
                </div>


                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('subkriteria.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
