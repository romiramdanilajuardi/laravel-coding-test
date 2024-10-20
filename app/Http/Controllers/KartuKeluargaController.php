<?php

namespace App\Http\Controllers;

use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KartuKeluargaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input pencarian
        $search = $request->input('search');

        // Jika ada pencarian, filter data berdasarkan kolom yang sesuai
        if ($search) {
            $kartuKeluarga = KartuKeluarga::where('no_kk', 'like', "%{$search}%")
                ->orWhere('kepala_keluarga', 'like', "%{$search}%")
                ->paginate(20); // Menggunakan paginate
        } else {
            // Jika tidak ada pencarian, tampilkan semua data dengan pagination
            $kartuKeluarga = KartuKeluarga::paginate(20); // Menggunakan paginate
        }

        return view('kartu-keluarga.index', compact('kartuKeluarga', 'search'));
    }


    public function create()
    {
        return view('kartu-keluarga.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $this->validateRequest($request);

        // Simpan data Kartu Keluarga baru
        KartuKeluarga::create($request->all());

        // Redirect dengan flash message sukses
        return redirect()->route('kartu-keluarga.index')->with('success', 'Kartu Keluarga berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kartuKeluarga = KartuKeluarga::findOrFail($id);
        return view('kartu-keluarga.edit', compact('kartuKeluarga'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $this->validateRequest($request);

        // Temukan Kartu Keluarga yang akan diupdate
        $kartuKeluarga = KartuKeluarga::findOrFail($id);

        // Update data Kartu Keluarga
        $kartuKeluarga->update($request->all());

        // Redirect dengan flash message sukses
        return redirect()->route('kartu-keluarga.index')->with('success', 'Kartu Keluarga berhasil diubah.');
    }

    public function destroy($id)
    {
        $kartuKeluarga = KartuKeluarga::findOrFail($id);
        $kartuKeluarga->delete();

        return redirect()->route('kartu-keluarga.index')->with('success', 'Kartu Keluarga berhasil dihapus.');
    }

    public function show($id)
    {
        $kartuKeluarga = KartuKeluarga::findOrFail($id);
        return view('kartu-keluarga.show', compact('kartuKeluarga'));
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|max:16',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt'=> 'required|string',
            'rw' => 'required|string',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
        ]);
    }
}
