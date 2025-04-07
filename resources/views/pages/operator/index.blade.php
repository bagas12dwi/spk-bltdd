@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="page-inner">
            @include('components.title', [
                'title' => 'Data Operator',
            ])

        </div>
        <div class="container-table">
            <div class="button-container">
                <a href="{{ route('operator.create') }}">
                    <button class="btn btn-primary">Tambah Data</button>
                </a>
            </div>

            @include('components.search', [
                'route' => route('operator.index'),
            ])

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $operator)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $operator->name }}</td>
                            <td>{{ $operator->email }}</td>
                            <td>
                                <a href="{{ route('operator.destroy', $operator->id) }}" class="action-btn"
                                    data-confirm-delete="true">🗑️</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data ditemukan.</td>
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
