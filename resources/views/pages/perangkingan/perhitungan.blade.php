@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Detail Perhitungan',
            ])
        </div>
        <div class="container-table">
            <h4>Bobot Kriteria</h4>
            <div id="printArea">
                <table>
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Total</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteriaList as $kriteria)
                            <tr>
                                <td>{{ $kriteria->nama_kriteria }}</td>
                                <td>{{ number_format($rowSums[$kriteria->id], 3) }}</td>
                                <td>{{ number_format($rowSums[$kriteria->id] / $countKriteria, 3) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="container-table">
            <h4>Data Alternatif </h4>
            <div id="printArea">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            @foreach ($kriteriaList as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
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

                                        @endphp
                                        <td>{{ $bobot }}</td>
                                    @endforeach

                                    @php
                                        $totalScores[$idWarga] = $total;
                                    @endphp
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Min Bobot</th>
                            @foreach ($kriteriaList as $kriteria)
                                <th>{{ isset($bobotValues[$kriteria->id]) ? min($bobotValues[$kriteria->id]) : '-' }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th colspan="2">Max Bobot</th>
                            @foreach ($kriteriaList as $kriteria)
                                <th>{{ isset($bobotValues[$kriteria->id]) ? max($bobotValues[$kriteria->id]) : '-' }}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br><br>
        <div class="container-table">
            <h4>Bobot Nilai Utility</h4>
            <p>Menentukan Bobot Nilai Utility dengan rumus <span class="fw-bold">(bobot - minimal bobot) / (maksimal bobot -
                    minimal bobot) * 100</span></p>
            <div id="printArea">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            @foreach ($kriteriaList as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
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
                                        <td>{{ $bobotValue }}</td>
                                    @endforeach

                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="container-table">
            <h4>Nilai Akhir</h4>
            <p>Menghitung Nilai Akhir dengan rumus <span class="fw-bold">Bobot Alternatif * Bobot Kriteria</span></p>
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
                    <tbody class="tbody-class">
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
            let rows = document.querySelectorAll(".tbody-class tr");
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
