@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => $title,
            ])

        </div>
        <div class="container-form">
            <form action="{{ route('operator.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama :</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Masukkan Password" />
                </div>

                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('operator.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
