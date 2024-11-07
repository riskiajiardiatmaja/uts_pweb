<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    public function index()
    {
        // $models = Pasien::all();
        $data['pasiens'] = \App\Models\Pasien::latest()->paginate(10);
        return view('pasien_index', $data);
    }


    public function create()
    {

        return view('pasien_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien',
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5000'
            ]);
            $pasien = new \App\Models\Pasien(); //membuat objek kosong di variabel model
             $pasien->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData
             $pasien->foto = $request->file('foto')->store('images', 'public'); //mengisi objek dengan pathFoto
             $pasien->save(); //menyimpan data ke database
            flash('Data sudah disimpan')->success();
            return back();
            //mengarahkan user ke url sebelumnya yaitu /pasien/create dengan membawa variabel pesan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['pasien'] = \App\Models\Pasien::findOrFail($id);
        return view('pasien_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien,' . $id,
            'nama' => 'required',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', // Foto boleh null
            'alamat' => 'nullable',
        ]);

        $pasien = \App\Models\Pasien::findOrFail($id);
        $pasien->fill($requestData);

        // Cek jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // Hapus file foto lama jika ada
            Storage::delete($pasien->foto);
            // Simpan file foto baru
            $pasien->foto = $request->file('foto')->store('images', 'public');
        }

        $pasien->save();
        flash('Data sudah diupdate')->success();
        return redirect('/pasien');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = \App\Models\Pasien::findOrFail($id);
        if($pasien->daftar->count() > 0) {
            flash('Data tidak bisa dihapus karena sudah ada data pendaftaran')->error();
            return back();
        }

        if($pasien->foto !=null && Storage::exists($pasien->foto)) {
            Storage::delete($pasien->foto);
        }
        $pasien->delete();
        flash('Data sudah dihapus')->success();
        return back();
    }
}
