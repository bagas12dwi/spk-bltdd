@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Kriteria Warga',
            ])
        </div>

        <div class="container-table">
            <div class="button-container">
                <a href="{{ route('kriteria-warga.create') }}">
                    <button class="btn">Tambah Data</button>
                </a>
            </div>

            @include('components.search', [
                'route' => route('kriteria-warga.index'),
            ])

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>

                        {{-- Generate table headers based on available kriteria --}}
                        @foreach ($kriteriaList as $kriteria)
                            <th>{{ $kriteria->nama_kriteria }}</th>
                        @endforeach

                        <th style="width: 8%!important">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = ($pagination->currentPage() - 1) * $pagination->perPage() + 1; @endphp
                    @foreach ($kriteriaWarga as $batch => $groupedByWarga)
                        @foreach ($groupedByWarga as $idWarga => $kriteriaGroup)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kriteriaGroup->first()->warga->nama ?? '-' }}
                                </td>

                                {{-- Generate table data dynamically --}}
                                @foreach ($kriteriaList as $kriteria)
                                    @php
                                        $value = $kriteriaGroup->where('id_kriteria', $kriteria->id)->first();
                                    @endphp
                                    <td>{{ $value->subkriteria->nama_subkriteria ?? '-' }}</td>
                                @endforeach

                                <td>
                                    <a href="{{ route('kriteria-warga.edit', $idWarga) }}" class="action-btn">✏️</a>
                                    <form action="{{ route('kriteria-warga.destroy', $idWarga) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination Controls --}}
            <div class="pagination">
                {{ $pagination->links() }}
            </div>
        </div>
    </div>
@endsection
