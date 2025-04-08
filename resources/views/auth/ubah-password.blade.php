@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title')
        </div>
        <div class="container-form">
            <form action="{{ route('ubah-password.store') }}" method="POST">
                @csrf

                {{-- @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif --}}

                <div class="mb-3">
                    <label for="old_password" class="form-label">Password Lama :</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                        name="old_password" id="old_password" />
                    @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Password Baru :</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        name="new_password" id="new_password" />
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password :</label>
                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                        name="confirm_password" id="confirm_password" />
                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="button-container mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
