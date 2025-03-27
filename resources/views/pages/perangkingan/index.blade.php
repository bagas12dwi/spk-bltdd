@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Hasil Perangkingan',
            ])
        </div>

        <div class="container-table">
            <button onclick="printTable()" class="btn btn-primary mb-3">Cetak PDF</button>
            <a href="{{ route('perhitungan') }}" class="btn btn-primary mb-3">Lihat Perhitungan</a>
            <div id="printArea">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            @foreach ($kriteriaList as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                            <th>Total</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $bobotValues = [];
                            $totalScores = [];
                        @endphp

                        @foreach ($kriteriaWarga as $batch => $groupedByWarga)
                            @foreach ($groupedByWarga as $idWarga => $kriteriaGroup)
                                @foreach ($kriteriaList as $kriteria)
                                    @php
                                        $value = $kriteriaGroup->where('id_kriteria', $kriteria->id)->first();
                                        $bobot = $value->subkriteria->bobot ?? null;
                                        $bobotValues[$kriteria->id][] = $bobot;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endforeach

                        @foreach ($kriteriaWarga as $batch => $groupedByWarga)
                            @foreach ($groupedByWarga as $idWarga => $kriteriaGroup)
                                @php
                                    $total = 0;
                                @endphp
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kriteriaGroup->first()->warga->nama ?? '-' }}</td>

                                    @foreach ($kriteriaList as $kriteria)
                                        @php
                                            $value = $kriteriaGroup->where('id_kriteria', $kriteria->id)->first();
                                            $bobot = $value->subkriteria->bobot ?? null;

                                            $minBobot = isset($bobotValues[$kriteria->id])
                                                ? min($bobotValues[$kriteria->id])
                                                : null;
                                            $maxBobot = isset($bobotValues[$kriteria->id])
                                                ? max($bobotValues[$kriteria->id])
                                                : null;

                                            if (
                                                $bobot !== null &&
                                                $minBobot !== null &&
                                                $maxBobot !== null &&
                                                $maxBobot - $minBobot != 0
                                            ) {
                                                $bobotValue = (($bobot - $minBobot) / ($maxBobot - $minBobot)) * 100;
                                            } else {
                                                $bobotValue = 0;
                                            }

                                            $weightedScore = ($bobotValue * $rowSums[$kriteria->id]) / $countKriteria;
                                            $total += $weightedScore;
                                        @endphp
                                        <td>{{ number_format($weightedScore, 2) }}</td>
                                    @endforeach

                                    @php
                                        $totalScores[$idWarga] = $total;
                                    @endphp

                                    <td>{{ number_format($total, 2) }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @php
        arsort($totalScores);
        $rankings = [];
        $rank = 1;
        foreach ($totalScores as $id => $score) {
            $rankings[$id] = $rank++;
        }
    @endphp

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let rows = document.querySelectorAll("tbody tr");
            rows.forEach((row) => {
                let wargaName = row.querySelector("td:nth-child(2)").innerText.trim();
                let rankCell = row.querySelector("td:last-child");
                @foreach ($rankings as $id => $rank)
                    if (wargaName === "{{ $kriteriaWarga[$batch][$id]->first()->warga->nama ?? '-' }}") {
                        rankCell.innerText = "{{ $rank }}";
                    }
                @endforeach
            });
        });

        function printTable() {
            var printContents = document.getElementById("printArea").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
