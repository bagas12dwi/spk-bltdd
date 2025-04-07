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
                <h5>Matriks Perbandingan Berpasangan</h5>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Kriteria</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                    </tr>

                    @php
                        $columnSums = array_fill_keys($kriterias->pluck('id')->toArray(), 0);
                    @endphp

                    @foreach ($kriterias as $row)
                        <tr>
                            <td>{{ $row->nama_kriteria }}</td>
                            @foreach ($kriterias as $col)
                                @php
                                    if ($row->id == $col->id) {
                                        $value = 1; // Diagonal values are always 1
                                    } else {
                                        $key = $row->id . '-' . $col->id;
                                        $inverseKey = $col->id . '-' . $row->id;
                                        $value =
                                            $comparisons[$key]->bobot ??
                                            (isset($comparisons[$inverseKey])
                                                ? round(1 / $comparisons[$inverseKey]->bobot, 3)
                                                : 1);
                                    }
                                    $columnSums[$col->id] += $value;
                                @endphp
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach

                    <!-- Last row for column sums -->
                    <tr>
                        <td><strong>Jumlah</strong></td>
                        @foreach ($kriterias as $col)
                            <td><strong>{{ round($columnSums[$col->id], 3) }}</strong></td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div class="container-table">
            <!-- Normalized Matrix -->
            <div class="box">
                <h5>Normalisasi Matriks Perbandingan Berpasangan</h5>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Kriteria</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                        <th>Jumlah</th> <!-- Column for row sum -->
                    </tr>

                    @foreach ($kriterias as $row)
                        <tr>
                            <td>{{ $row->nama_kriteria }}</td>
                            @foreach ($kriterias as $col)
                                @php
                                    $key = $row->id . '-' . $col->id;
                                    $inverseKey = $col->id . '-' . $row->id;
                                    $pairwiseValue =
                                        $comparisons[$key]->bobot ??
                                        (isset($comparisons[$inverseKey])
                                            ? round(1 / $comparisons[$inverseKey]->bobot, 3)
                                            : 1);
                                    $value = $pairwiseValue / $columnSums[$col->id]; // Normalize value
                                @endphp
                                <td>{{ number_format($value, 3) }}</td>
                            @endforeach
                            <td><b>{{ number_format($rowSums[$row->id], 3) }} {{ $row->id }}</b></td>
                            <!-- Sum displayed here -->
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br><br>
        <div class="container-table">
            <!-- Weighted Sum Vector Matrix -->
            <div class="box">
                <h5>Weighted Sum Vector (WSV) Matrix</h5>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Kriteria</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach
                        <th>Jumlah</th> <!-- Sum column -->
                    </tr>

                    @foreach ($kriterias as $row)
                        <tr>
                            <td>{{ $row->nama_kriteria }}</td>
                            @foreach ($kriterias as $col)
                                @php
                                    $key = $row->id . '-' . $col->id;
                                    $inverseKey = $col->id . '-' . $row->id;
                                    $pairwiseValue =
                                        $comparisons[$key]->bobot ??
                                        (isset($comparisons[$inverseKey])
                                            ? round(1 / $comparisons[$inverseKey]->bobot, 3)
                                            : 1);
                                    $normalizedValue = $pairwiseValue / $columnSums[$col->id];
                                    $weightedValue = $pairwiseValue * $priorityVector[$col->id]; // Multiply by Priority Vector
                                @endphp
                                <td>{{ number_format($weightedValue, 3) }}</td>
                            @endforeach
                            <td><b>{{ number_format($weightedSumVector[$row->id], 3) }}</b></td>
                            <!-- WSV displayed at the end -->
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br><br>
        <div class="container-table">
            <!-- Konsistensi Rasio -->
            <h5>Konsistensi Rasio (CR)</h5>
            <table>
                <tr>
                    <th>Lambda Max</th>
                    <td>{{ number_format($lambdaMax, 3) }}</td>
                </tr>
                <tr>
                    <th>CI</th>
                    <td>{{ number_format($CI, 3) }}</td>
                </tr>
                <tr>
                    <th>CR</th>
                    <td>
                        @if ($CR < 0.1)
                            <p style="color: green; font-weight: bold; margin-bottom: 0">✅ KONSISTEN</p>
                        @else
                            <p style="color: red; font-weight: bold; margin-bottom: 0">❌ TIDAK KONSISTEN</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
