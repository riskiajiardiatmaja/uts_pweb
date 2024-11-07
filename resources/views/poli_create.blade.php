@extends('layouts.app_modern', ['title' => 'Tambah Poli'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Pasien Poli</h5>
        <form action="/poli" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mt-1 mb-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="biaya">Biaya</label>
                <input type="text" class="form-control @error('biaya') is-invalid @enderror" id="biaya" name="biaya" value="{{ old('biaya') }}" oninput="Rp(this)">
                <input type="hidden" id="biayaHidden" name="biayaHidden" value="{{ old('biaya') }}">
                <span class="text-danger">{{ $errors->first('biaya') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="keterangan">keterangan</label>
                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
            </div>

            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>

{{-- JS --}}
<script>
    function Rp(input) {
        // Menghapus semua karakter yang bukan angka
        let value = input.value.replace(/\D/g, '');

        // Menambahkan pemisah ribuan
        let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Mengupdate nilai input
        input.value = formattedValue;

        // Menyimpan nilai asli tanpa pemisah ribuan ke dalam hidden input
        document.getElementById('biayaHidden').value = value; // Menyimpan nilai asli
    }
    </script>
@endsection
