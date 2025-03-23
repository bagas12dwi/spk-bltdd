@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title')
        </div>
        <div class="container-form">
            <form action="{{ isset($data) ? route('warga.update', $data->id) : route('warga.store') }}" method="post">
                @csrf
                @if (isset($data))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="nama" id="nama"
                        value="{{ old('nama', $data->nama ?? '') }}" placeholder="Masukkan Nama" />
                    <small class="form-text text-muted">Masukkan Nama Lengkap</small>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK :</label>
                    <input type="text" class="form-control" name="nik" id="nik"
                        value="{{ old('nik', $data->nik ?? '') }}" placeholder="Masukkan NIK" />
                    <small class="form-text text-muted">Masukkan NIK</small>
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
                        value="{{ old('tempat_lahir', $data->tempat_lahir ?? '') }}" placeholder="Masukkan Tempat Lahir" />
                    <small class="form-text text-muted">Masukkan Tempat Lahir</small>
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}" />
                    <small class="form-text text-muted">Masukkan Tanggal Lahir</small>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ old('alamat', $data->alamat ?? '') }}</textarea>
                </div>

                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
