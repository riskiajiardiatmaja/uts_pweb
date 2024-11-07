@extends('layouts.app_modern', ['title' => 'Data Pasien'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Data pasien</h3>
            <div class="row mb-3 mt-3">
                <div class="col-md-6">
                    <a href="/pasien/create" class="btn btn-primary btn-sm">Tambah pasien</a>
                </div>
                <div class="col-md-6 text-end">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari pasien...">
                        {{-- <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i> <!-- Ganti dengan ikon yang sesuai -->
                        </button> --}}
                    </div>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>No Pasien</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl Buat</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody id="patientTableBody">
                    @foreach ($pasiens as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_pasien }}</td>
                            <td>
                                @if ($item->foto)
                                    <img src="{{ \Storage::url($item->foto) }}" width="50px"/>
                                @else
                                <img src="{{ asset('storage/images/default.jpg') }}" width="50px"/>
                                @endif
                            </td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->umur }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="/pasien/{{ $item->id }}/edit" class="btn btn-warning btn-sm ml-2">
                                    Edit
                                </a>
                                <form action="/pasien/{{ $item->id }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm ml-2"
                                        onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pasiens->links() }}
        </div>
    </div>

    {{-- CSS --}}
    <style>
        th {
            border-bottom: 4px solid #000000; /* Garis bawah */
            text-align: center; /* Rata tengah */
            background-color: #f8f9fa; /* Warna latar belakang */
        }

        td {
            padding: 10px; /* Ruang dalam sel */
            text-align: center; /* Rata tengah */
        }
    </style>

    {{-- Js --}}
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#patientTableBody tr');

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                const name = cells[3].textContent.toLowerCase(); // Nama pasien
                const noPasien = cells[1].textContent.toLowerCase(); // No Pasien

                if (name.includes(filter) || noPasien.includes(filter)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    </script>
@endsection
