<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar;

class LaporanDaftarController extends Controller
{
    public function create()
    {
        $data['listPoli'] = [
            'poli-umum' => 'Poli Umum',
            'poli-gigi' => 'Poli Gigi',
            'poli-mata' => 'Poli Mata',
            'poli-anak' => 'Poli Anak',
        ];
        return view('laporan_daftar_create', $data);
    }

    public function index(Request $request)
    {
        $models = Daftar::query();
        if ($request->filled('tanggal_mulai')) {
            $models->whereDate('tanggal_daftar', '<=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_akhir')) {
            $models->whereDate('tanggal_daftar', '<=', $request->tanggal_akhir);
        }
        if ($request->filled('poli')) {
            $models->where('id', $request->poli);
        }
        $data['models'] = $models->latest()->get();
        return view('laporan_daftar_index', $data);
    }

    public function show($id)
{
    $daftar = Daftar::findOrFail($id);
    return view('laporan_daftar_show', compact('daftar'));
}
}
