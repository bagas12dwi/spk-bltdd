@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Kriteria',
            ])

        </div>
        <div class="container-table">
            <div class="button-container">
                <a href="{{ route('kriteria.create') }}">
                    <button class="btn btn-primary">Tambah Data</button>
                </a>
            </div>

            @include('components.search', [
                'route' => route('kriteria.index'),
            ])

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $kriteria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kriteria->nama_kriteria }}</td>
                            <td>
                                <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="action-btn">✏️</a>
                                <a href="{{ route('kriteria.destroy', $kriteria->id) }}" class="action-btn"
                                    data-confirm-delete="true">🗑️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data ditemukan.</td>
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
