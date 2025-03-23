@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Suibkriteria',
            ])

        </div>
        <div class="container-form">
            <form action="{{ route('operator.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" />
                    <small class="form-text text-muted">Masukkan Nama Lengkap</small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" />
                    <small class="form-text text-muted">Masukkan Email</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Masukkan Password" />
                    <small class="form-text text-muted">Masukkan Password</small>
                </div>

                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('operator.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
