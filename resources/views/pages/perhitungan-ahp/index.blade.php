@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Bobot Kriteria',
            ])
        </div>

        <div class="container-table">
            @if (count($kriterias) > 0)
                <div class="">
                    <div class="">
                        <h5>Nilai Preferensi / Bobot Kriteria</h5>
                    </div>
                    <div class="">
                        <form action="{{ route('perhitungan-ahp.store') }}" method="POST">
                            @csrf
                            <table class="">
                                <thead>
                                    <tr class="text-center">
                                        <th>Kriteria</th>
                                        <th>Terhadap</th>
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $i => $kriteria)
                                        @php
                                            $subKriterias = $kriterias->slice($i + 1);
                                            $rowCount = count($subKriterias);
                                        @endphp

                                        @if ($rowCount > 0)
                                            <tr>
                                                <td rowspan="{{ $rowCount + 1 }}">{{ $kriteria->nama_kriteria }}</td>
                                                @foreach ($subKriterias as $index => $sub)
                                                    @php
                                                        $key = $kriteria->id . '-' . $sub->id;
                                                        $existingValue = $comparisons[$key]->bobot ?? 3; // Default to 3 if not found
                                                    @endphp

                                                    @if ($index > 0)
                                            <tr>
                                        @endif
                                        <td>{{ $sub->nama_kriteria }}</td>
                                        <td>
                                            <input type="number" class="form-control"
                                                name="bobot[{{ $kriteria->id }}][{{ $sub->id }}]"
                                                value="{{ old("bobot.$kriteria->id.$sub->id", $existingValue) }}">
                                        </td>
                                        @if ($index > 0)
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tr>
            @endif
            @endforeach
            </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

        </div>
    </div>
@else
    <h4 class="text-center">Data Kriteria Belum Ditambahkan!</h4>
    @endif
    </div>
    </div>
@endsection
