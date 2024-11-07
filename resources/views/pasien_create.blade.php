@extends('layouts.app_modern', ['title' => 'Tambah Pasien'])
@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Pasien</h5>
        <form action="/pasien" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mt-1 mb-3">
                <label for="foto">Foto Pasien</label>
                <div class="d-flex align-items-center">
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto" style="display: none;">
                    <div class="border rounded p-2" style="width: 100px; height: 100px; background-color: #e9ecef; display: flex; align-items: center; justify-content: center;">
                        <img id="preview" src="{{ old('foto') ? asset('storage/' . old('foto')) : '' }}" alt="Preview" class="img-fluid" style="max-width: 100%; max-height: 100%;">
                    </div>
                    <button type="button" class="btn btn-secondary ms-2" onclick="document.getElementById('foto').click();">Choose File</button>
                </div>
                <span class="text-danger">{{ $errors->first('foto') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="nama">Nama Pasien</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="no_pasien">Nomor Pasien</label>
                <input type="text" class="form-control @error('no_pasien') is-invalid @enderror" id="no_pasien" name="no_pasien" value="{{ old('no_pasien') }}">
                <span class="text-danger">{{ $errors->first('no_pasien') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="umur">Umur</label>
                <input type="number" class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur" value="{{ old('umur') }}">
                <span class="text-danger">{{ $errors->first('umur') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="jenis_kelamin">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="laki-laki" {{ old('jenis_kelamin') === 'laki-laki' ? 'checked' : '' }}>
                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="perempuan" {{ old('jenis_kelamin') === 'perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
                <span class="text-danger">{{ $errors->first('jenis_kelamin') }}</span>
            </div>

            <div class="form-group mt-1 mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
            </div>

            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
@endsection
