@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title')
        </div>

        <div class="container-table">
            <div class="button-container">
                <button class="btn">Cetak Data</button>
                <a href="{{ route('warga.create') }}">
                    <button class="btn">Tambah Data</button>
                </a>
            </div>

            @include('components.search', [
                'route' => route('warga.index'),
            ])

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataWarga as $index => $warga)
                        <tr>
                            <td>{{ $dataWarga->firstItem() + $index }}</td>
                            <td>{{ $warga->nama }}</td>
                            <td>{{ $warga->nik }}</td>
                            <td>{{ $warga->tempat_lahir . ', ' . $warga->tanggal_lahir }}</td>
                            <td>{{ $warga->alamat }}</td>
                            <td>
                                <a href="{{ route('warga.edit', $warga->id) }}" class="action-btn">✏️</a>
                                <a href="{{ route('warga.destroy', $warga->id) }}" class="action-btn"
                                    data-confirm-delete="true">🗑️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @include('components.pagination', [
                'data' => $dataWarga->links(),
            ])
        </div>

    </div>
@endsection
