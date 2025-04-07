@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Suibkriteria',
            ])

        </div>
        <div class="container-table">
            <div class="button-container">
                <a href="{{ route('subkriteria.create') }}">
                    <button class="btn btn-primary">Tambah Data</button>
                </a>
            </div>

            @include('components.search', [
                'route' => route('subkriteria.index'),
            ])

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Subkriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $subkriteria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subkriteria->nama_subkriteria }}</td>
                            <td>{{ $subkriteria->kriteria->nama_kriteria }}</td>
                            <td>{{ $subkriteria->bobot }}</td>
                            <td>
                                <a href="{{ route('subkriteria.edit', $subkriteria->id) }}" class="action-btn">✏️</a>
                                <a href="{{ route('subkriteria.destroy', $subkriteria->id) }}" class="action-btn"
                                    data-confirm-delete="true">🗑️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @include('components.pagination', [
                'data' => $data->links(),
            ])
        </div>
    </div>
@endsection
