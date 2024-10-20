@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data Kartu Keluarga</h1>

    <!-- Tombol untuk membuka modal tambah -->
    <label for="add-modal" class="btn btn-primary text-white font-semibold">Tambah Kartu Keluarga</label>

    <!-- Modal Tambah Kartu Keluarga -->
    <input type="checkbox" id="add-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-slate-100">
            <h2 class="text-xl font-bold mb-4">Tambah Kartu Keluarga</h2>
            <form action="{{ route('kartu-keluarga.store') }}" method="POST"  id="addKartuKeluargaForm" >
                @csrf
                <div class="mb-4">
                    <label for="no_kk" class="block  text-[0.9rem] font-semibold">Nomor KK</label>
                    <input type="text" id="no_kk" name="no_kk" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="kepala_keluarga" class="block  text-[0.9rem] font-semibold">Kepala Keluarga</label>
                    <input type="text" id="kepala_keluarga" name="kepala_keluarga" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block  text-[0.9rem] font-semibold">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="rt" class="block  text-[0.9rem] font-semibold">RT</label>
                    <input type="text" id="rt" name="rt" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="rw" class="block  text-[0.9rem] font-semibold">RW</label>
                    <input type="text" id="rw" name="rw" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="kelurahan" class="block  text-[0.9rem] font-semibold">Kelurahan</label>
                    <input type="text" id="kelurahan" name="kelurahan" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="kecamatan" cfont-semibold text-[0.9rem] font-semibold">Kecamatan</label>
                    <input type="text" id="kecamatan" name="kecamatan" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="kabupaten" class="block  text-[0.9rem] font-semibold">Kabupaten</label>
                    <input type="text" id="kabupaten" name="kabupaten" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="provinsi" class="block  text-[0.9rem] font-semibold">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    <label for="add-modal" class="btn text-white">Batal</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Kartu Keluarga -->
    <div class=" flex justify-between items-center gap-x-4">
        <h2 class="text-xl font-bold mt-8">Daftar Kartu Keluarga</h2>
        <form method="GET" action="{{ route('kartu-keluarga.index') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kartu Keluarga..." class="input input-bordered bg-transparent">
            <button type="submit" class=" btn btn-primary text-white">Cari</button>
        </form>
    </div>

    <table class="table table-auto w-full mt-4 bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">No KK</th>
                <th class="px-4 py-2">Kepala Keluarga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kartuKeluarga as $kk)
                <tr>
                    <td class="border px-4 py-2">{{ $kk->no_kk }}</td>
                    <td class="border px-4 py-2">{{ $kk->kepala_keluarga }}</td>
                    <td class="border px-4 py-2 ">
                        <label for="detail-modal-{{ $kk->id }}" class=" cursor-pointer pl-2">
                            <i class="fas fa-eye"></i>
                        </label>
                        <label for="edit-modal-{{ $kk->id }}" class=" cursor-pointer pl-2">
                            <i class="fas fa-edit"></i>
                        </label>
                        <form action="{{ route('kartu-keluarga.destroy', $kk->id) }}" method="POST" class="inline-block delete-form pl-2 ">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button cursor-pointer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Detail Kartu Keluarga -->
                <input type="checkbox" id="detail-modal-{{ $kk->id }}" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-slate-100">
                        <h2 class="text-xl font-bold mb-4">Detail Kartu Keluarga</h2>
                        <p><strong>Nomor KK:</strong> {{ $kk->no_kk }}</p>
                        <p><strong>Kepala Keluarga:</strong> {{ $kk->kepala_keluarga }}</p>
                        <p><strong>Alamat:</strong> {{ $kk->alamat }}</p>
                        <p><strong>RT:</strong> {{ $kk->rt }}</p>
                        <p><strong>RW:</strong> {{ $kk->rw }}</p>
                        <p><strong>Kelurahan:</strong> {{ $kk->kelurahan }}</p>
                        <p><strong>Kecamatan:</strong> {{ $kk->kecamatan }}</p>
                        <p><strong>Kabupaten:</strong> {{ $kk->kabupaten }}</p>
                        <p><strong>Provinsi:</strong> {{ $kk->provinsi }}</p>
                        <div class="modal-action">
                            <label for="detail-modal-{{ $kk->id }}" class="btn btn-primary text-white">Tutup</label>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Kartu Keluarga -->
                <input type="checkbox" id="edit-modal-{{ $kk->id }}" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-slate-100">
                        <h2 class="text-xl font-bold mb-4">Edit Kartu Keluarga</h2>
                        <form action="{{ route('kartu-keluarga.update', $kk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="no_kk" class="block font-semibold text-[0.9rem]">Nomor KK</label>
                                <input type="text" id="no_kk" name="no_kk" class="input input-bordered w-full bg-transparent" value="{{ $kk->no_kk }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="kepala_keluarga" class="block font-semibold text-[0.9rem]">Kepala Keluarga</label>
                                <input type="text" id="kepala_keluarga" name="kepala_keluarga" class="input input-bordered w-full bg-transparent" value="{{ $kk->kepala_keluarga }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="alamat" class="block font-semibold text-[0.9rem]">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="input input-bordered w-full bg-transparent " value="{{ $kk->alamat }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="rt" class="block font-semibold text-[0.9rem]">RT</label>
                                <input type="text" id="rt" name="rt" class="input input-bordered w-full bg-transparent" value="{{ $kk->rt }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="rw" class="block font-semibold text-[0.9rem]">RW</label>
                                <input type="text" id="rw" name="rw" class="input input-bordered w-full bg-transparent" value="{{ $kk->rw }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="kelurahan" class="block font-semibold text-[0.9rem]">Kelurahan</label>
                                <input type="text" id="kelurahan" name="kelurahan" class="input input-bordered w-full bg-transparent" value="{{ $kk->kelurahan }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="kecamatan" class="block font-semibold text-[0.9rem]">Kecamatan</label>
                                <input type="text" id="kecamatan" name="kecamatan" class="input input-bordered w-full bg-transparent" value="{{ $kk->kecamatan }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="kabupaten" class="block font-semibold text-[0.9rem]">Kabupaten</label>
                                <input type="text" id="kabupaten" name="kabupaten" class="input input-bordered w-full bg-transparent" value="{{ $kk->kabupaten }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="provinsi" class="block font-semibold text-[0.9rem]">Provinsi</label>
                                <input type="text" id="provinsi" name="provinsi" class="input input-bordered w-full bg-transparent" value="{{ $kk->provinsi }}" required>
                            </div>
                            <div class="modal-action">
                                <button type="submit" class="btn text-white btn-primary">Simpan</button>
                                <label for="edit-modal-{{ $kk->id }}" class="btn text-white">Batal</label>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>

    </table>
        <div class="mt-4">
            {{ $kartuKeluarga->links() }}
        </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Form tambah Kartu Keluarga di modal
            const addForm = document.getElementById('addKartuKeluargaForm');

            // Konfirmasi saat menambah Kartu Keluarga di modal
            if (addForm) {
                addForm.addEventListener('submit', (event) => {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menyimpan data ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Menggunakan AJAX untuk mengirim form
                            $.ajax({
                                url: addForm.action, // URL action dari form
                                method: 'POST', // Metode pengiriman
                                data: $(addForm).serialize(), // Serialize form data
                                success: function(response) {
                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message, // Ambil pesan dari response
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Setelah menutup swal, bisa lakukan reload atau update UI
                                        location.reload(); // Reload halaman
                                    });
                                },
                                error: function(xhr) {
                                    // Tampilkan pesan error jika ada
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            }

            // Konfirmasi saat menghapus Kartu Keluarga di modal
            document.querySelectorAll('.delete-button').forEach((button) => {
                button.addEventListener('click', (event) => {
                    const form = event.target.closest('form'); // Mencari form terdekat

                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus data ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Menggunakan AJAX untuk menghapus
                            $.ajax({
                                url: form.action, // URL action dari form
                                method: 'DELETE', // Metode penghapusan
                                data: {
                                    _token: '{{ csrf_token() }}' // Kirim token CSRF
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message, // Ambil pesan dari response
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Setelah menutup swal, bisa lakukan reload atau update UI
                                        location.reload(); // Reload halaman
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection


