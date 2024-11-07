@extends('layouts.app_modern', ['title' => 'Data Poli'])

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Data poli</h3>
        <div class="row mb-3 mt-3">
            <div class="col-md-6">
                <a href="/poli/create" class="btn btn-primary btn-sm">Tambah poli</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead style="border-bottom: 2px #000">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Biaya</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polis as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration + ($polis->currentPage() - 1) * $polis->perPage() }}</td>
                    {{-- <td>{{ $item->id }}</td> --}}
                    <td>{{ $item->nama }}</td>
                    <td>{{ 'Rp ' . number_format($item->biaya, 0, ',', '.') }}</td>
                    <td>{{ $item->keterangan }}</td>
                    {{-- <td>{{ $item->created_at }}</td> --}}
                    <td>
                        <a href="/poli/{{ $item->id }}/edit" class="btn btn-warning btn-sm ml-2">Edit</a>
                        <form action="/poli/{{ $item->id }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm ml-2" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $polis->links() }}
    </div>
</div>
@endsection
