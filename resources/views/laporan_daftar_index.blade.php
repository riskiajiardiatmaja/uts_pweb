@extends('layouts.app_modern_laporan')
@section('content')
    <h3>LAPORAN DATA PENDAFTARAN PASIEN</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="1%">NO</th>
                <th>No Pasien</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Tgl Daftar</th>
                <th>Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($models as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pasien->no_pasien }}</td>
                    <td>{{ $item->pasien->nama }}</td>
                    <td>{{ $item->pasien->umur }}</td>
                    <td>{{ $item->pasien->jenis_kelamin }}</td>
                    <td>{{ $item->tanggal_daftar }}</td>
                    <td>{{ $item->poli ? $item->poli->nama : 'Tidak Diketahui' }}</td>
                    <td>
                        <!-- Link untuk mencetak laporan -->
                        <a href="{{ route('laporan_daftar_show', $item->id) }}" class="btn btn-primary">Cetak</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
