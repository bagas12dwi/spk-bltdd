@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Suibkriteria',
            ])

        </div>
        <div class="container-form">
            <form action="{{ route('kriteria-warga.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nama</label>
                    <select class="form-select form-select" name="id_data_warga" id="id_data_warga">
                        <option disabled selected>Pilih Nama Warga</option>
                        @foreach ($dataWarga as $warga)
                            <option value="{{ $warga->id }}">{{ $warga->nama }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <label for="" class="form-label">{{ $loop->iteration }}.
                            {{ $kriteria->nama_kriteria }}</label>
                        <div class="d-flex">
                            @foreach ($kriteria->subkriteria as $subkriteria)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="subkriteria[{{ $kriteria->id }}]"
                                        value="{{ $subkriteria->id }}" />
                                    <label class="form-check-label" for=""> {{ $subkriteria->nama_subkriteria }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="button-container">
                    <button type="submit" class="btn">Simpan</button>
                    <button type="reset" class="btn">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
