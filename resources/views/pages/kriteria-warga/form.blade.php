@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => $idWarga != 0 ? 'Edit Data Kriteria Warga' : 'Tambah Data Kriteria Warga',
            ])
        </div>
        <div class="container-form">
            <form
                action="{{ $idWarga != 0 ? route('kriteria-warga-update', ['idWarga' => $idWarga, 'batch' => $batch]) : route('kriteria-warga.store') }}"
                method="post">

                @csrf
                @if ($idWarga != 0)
                    @method('PUT')
                @endif

                <input type="hidden" name="idWarga" value="{{ $idWarga ?? 0 }}">
                <input type="hidden" name="batch" value="{{ $batch ?? 0 }}">

                <div class="mb-3">
                    <label for="id_data_warga" class="form-label">Nama</label>
                    <select class="form-select" name="id_data_warga" id="id_data_warga">
                        <option disabled {{ $kriteriaWarga->isEmpty() ? 'selected' : '' }}>Pilih Nama Warga</option>
                        @foreach ($dataWarga as $warga)
                            <option value="{{ $warga->id }}"
                                {{ !$kriteriaWarga->isEmpty() && $kriteriaWarga->first()->id_data_warga == $warga->id ? 'selected' : '' }}>
                                {{ $warga->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @foreach ($kriterias as $kriteria)
                    <div class="mb-3">
                        <label class="form-label">{{ $loop->iteration }}. {{ $kriteria->nama_kriteria }}</label>
                        <div class="d-flex">
                            @foreach ($kriteria->subkriteria as $subkriteria)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="subkriteria[{{ $kriteria->id }}]"
                                        value="{{ $subkriteria->id }}"
                                        {{ isset($selectedSubkriteria[$kriteria->id]) && $selectedSubkriteria[$kriteria->id] == $subkriteria->id ? 'checked' : '' }} />
                                    <label class="form-check-label"> {{ $subkriteria->nama_subkriteria }} </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach


                <div class="button-container">
                    <button type="submit" class="btn btn-primary">{{ $idWarga != 0 ? 'Update' : 'Simpan' }}</button>
                    <a href="{{ route('kriteria-warga.index') }}" type="reset" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
