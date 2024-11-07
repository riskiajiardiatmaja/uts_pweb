@extends('layouts.app_modern_laporan')

@section('content')
    <div class="container">
        <h3>Detail Pendaftaran Pasien</h3>
        <table class="table table-bordered">
            <tr>
                <th>No Pasien</th>
                <td>{{ $daftar->pasien->no_pasien }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $daftar->pasien->nama }}</td>
            </tr>
            <tr>
                <th>Umur</th>
                <td>{{ $daftar->pasien->umur }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $daftar->pasien->jenis_kelamin }}</td>
            </tr>
            <tr>
                <th>Tanggal Daftar</th>
                <td>{{ $daftar->tanggal_daftar }}</td>
            </tr>
            <tr>
                <th>Poli</th>
                <td>{{ $daftar->poli ? $daftar->poli->nama : 'Tidak Diketahui' }}</td>
            </tr>
        </table>
        <button onclick="window.print()">Cetak Laporan</button>
    </div>
@endsection
