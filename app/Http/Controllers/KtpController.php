<?php

namespace App\Http\Controllers;

use App\Models\Ktp;
use App\Models\KartuKeluarga;
use Illuminate\Http\Request;

class KtpController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input pencarian
        $search = $request->input('search');

        // Jika ada pencarian, filter data berdasarkan kolom yang sesuai
        if ($search) {
            $ktp = Ktp::with('kartuKeluarga') // Pastikan menggunakan relasi
                ->where('nik', 'like', "%{$search}%")
                ->orWhere('nama', 'like', "%{$search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                ->orWhereHas('kartuKeluarga', function($query) use ($search) {
                    $query->where('no_kk', 'like', "%{$search}%")
                          ->orWhere('kepala_keluarga', 'like', "%{$search}%");
                })
                ->paginate(20); // Menggunakan paginate
        } else {
            // Jika tidak ada pencarian, tampilkan semua data dengan pagination
            $ktp = Ktp::with('kartuKeluarga')->paginate(20); // Menggunakan paginate
        }

        // Ambil data Kartu Keluarga
        $kartu_keluarga = KartuKeluarga::all();

        return view('ktp.index', compact('ktp', 'kartu_keluarga', 'search'));
    }



    public function create()
    {
        $kartu_keluarga = KartuKeluarga::all();
        return view('ktp.create', compact('kartu_keluarga'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request); // Validasi data input

        // Simpan data KTP baru
        Ktp::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ktp.index')->with('success', 'KTP berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $ktp = Ktp::findOrFail($id);
        $kartu_keluarga = KartuKeluarga::all();
        return view('ktp.edit', compact('ktp', 'kartu_keluarga'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request); // Validasi input

        // Temukan KTP yang akan diupdate
        $ktp = Ktp::findOrFail($id);

        // Update data KTP
        $ktp->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ktp.index')->with('success', 'KTP berhasil diubah.');
    }


    public function destroy($id)
    {
        // Hapus data KTP
        $ktp = Ktp::findOrFail($id);
        $ktp->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ktp.index')->with('success', 'KTP berhasil dihapus.');
    }


    public function show($id)
    {
        $ktp = Ktp::with('kartuKeluarga')->findOrFail($id);
        return view('ktp.show', compact('ktp'));
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:17',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date', // Pastikan tipe data sesuai
            'tempat_lahir' => 'required|string',
            'pekerjaan' => 'required|string',
            'status_perkawinan' => 'required|string', // Pastikan nama ini benar
            'kartu_keluarga_id' => 'required|string',
        ]);
    }
}
