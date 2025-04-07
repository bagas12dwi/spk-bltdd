@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Hasil Perhitungan AHP',
            ])
        </div>
        <div class="container-table">
            <!-- Matriks Perbandingan Berpasangan -->
            <div class="box">
                <h5 class="text-center">Belum Ada Data Kriteria</h5>
            </div>
        </div>
    </div>
@endsection
