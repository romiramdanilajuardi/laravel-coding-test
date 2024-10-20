@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data KTP</h1>

    <!-- Tombol untuk membuka modal tambah -->
    <label for="add-modal" class="btn btn-primary text-white">Tambah KTP</label>

    <!-- Modal Tambah KTP -->
    <input type="checkbox" id="add-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-slate-100">
            <h2 class="text-xl font-bold mb-4">Tambah KTP</h2>
            <form action="{{ route('ktp.store') }}" method="POST" id="addKtpForm">
                @csrf
                <div class="mb-4">
                    <label for="nik" class="block text-[0.9rem] font-semibold">NIK</label>
                    <input type="text" id="nik" name="nik" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-[0.9rem] font-semibold">Nama</label>
                    <input type="text" id="nama" name="nama" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="jenis_kelamin" class="block text-[0.9rem] font-semibold">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="select select-bordered w-full bg-transparent" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tanggal_lahir" class="block text-[0.9rem] font-semibold">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="tempat_lahir" class="block text-[0.9rem] font-semibold">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="pekerjaan" class="block text-[0.9rem] font-semibold">Pekerjaan</label>
                    <input type="text" id="pekerjaan" name="pekerjaan" class="input input-bordered w-full bg-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="status_perkawinan" class="block text-[0.9rem] font-semibold">Status Perkawinan</label>
                    <select id="status_perkawinan" name="status_perkawinan" class="select select-bordered w-full bg-transparent" required>
                        <option value="">Pilih Status Perkawinan</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="kartu_keluarga_id" class="block text-[0.9rem] font-semibold">Kartu Keluarga</label>
                    <select id="kartu_keluarga_id" name="kartu_keluarga_id" class="select select-bordered w-full bg-transparent" required>
                        <option value="">Pilih Kartu Keluarga</option>
                        @foreach($kartu_keluarga as $kk)
                            <option value="{{ $kk->id }}">{{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn text-white btn-primary">Simpan</button>
                    <label for="add-modal" class="btn text-white">Batal</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar KTP -->
    <div class=" flex justify-between items-center gap-x-4">
        <h2 class="text-xl font-bold mt-8">Daftar KTP</h2>
        <form method="GET" action="{{ route('ktp.index') }}">
            <div class=" flex ">
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari data ..." class="input input-bordered bg-transparent">
                <button type="submit" class="btn btn-primary text-white">Cari</button>
            </div>
    </div>

    </form>
    <table class="table table-auto w-full mt-4 bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">NIK</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Jenis Kelamin</th>
                <th class="px-4 py-2">Kartu Keluarga</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ktp as $kt)
                <tr>
                    <td class="border px-4 py-2">{{ $kt->nik }}</td>
                    <td class="border px-4 py-2">{{ $kt->nama }}</td>
                    <td class="border px-4 py-2">{{ $kt->jenis_kelamin }}</td>
                    <td class="border px-4 py-2">{{ $kt->kartuKeluarga->no_kk ?? 'Tidak Ada' }}</td>
                    <td class="border px-4 py-2">
                        <label for="detail-modal-{{ $kt->id }}" class="cursor-pointer pl-2">
                            <i class="fas fa-eye"></i>
                        </label>
                        <label for="edit-modal-{{ $kt->id }}" class="cursor-pointer pl-2">
                            <i class="fas fa-edit"></i>
                        </label>
                        <form action="{{ route('ktp.destroy', $kt->id) }}" method="POST" class="inline-block delete-form cursor-pointer pl-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button cursor-pointer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Detail KTP -->
                <input type="checkbox" id="detail-modal-{{ $kt->id }}" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-slate-100">
                        <h2 class="text-xl font-bold mb-4">Detail KTP</h2>
                        <p><strong>NIK:</strong> {{ $kt->nik }}</p>
                        <p><strong>Nama:</strong> {{ $kt->nama }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $kt->jenis_kelamin }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $kt->tanggal_lahir }}</p>
                        <p><strong>Tempat Lahir:</strong> {{ $kt->tempat_lahir }}</p>
                        <p><strong>Pekerjaan:</strong> {{ $kt->pekerjaan }}</p>
                        <p><strong>Status Perkawinan:</strong> {{ $kt->status_perkawinan }}</p>
                        <p><strong>Kartu Keluarga:</strong> {{ $kt->kartuKeluarga->no_kk ?? 'Tidak Ada' }}</p>
                        <div class="modal-action">
                            <label for="detail-modal-{{ $kt->id }}" class="btn btn-primary text-white">Tutup</label>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit KTP -->
                <input type="checkbox" id="edit-modal-{{ $kt->id }}" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-slate-100">
                        <h2 class="text-xl font-bold mb-4">Edit KTP</h2>
                        <form action="{{ route('ktp.update', $kt->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="nik" class="block text-[0.9rem] font-semibold">NIK</label>
                                <input type="text" id="nik" name="nik" class="input input-bordered w-full bg-transparent" value="{{ $kt->nik }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="block text-[0.9rem] font-semibold">Nama</label>
                                <input type="text" id="nama" name="nama" class="input input-bordered w-full bg-transparent" value="{{ $kt->nama }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="jenis_kelamin" class="block text-[0.9rem] font-semibold">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="select select-bordered w-full bg-transparent" required>
                                    <option value="Laki-laki" {{ $kt->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $kt->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="block text-[0.9rem] font-semibold">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="input input-bordered w-full bg-transparent" value="{{ $kt->tanggal_lahir }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="tempat_lahir" class="block text-[0.9rem] font-semibold">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="input input-bordered w-full bg-transparent" value="{{ $kt->tempat_lahir }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="pekerjaan" class="block text-[0.9rem] font-semibold">Pekerjaan</label>
                                <input type="text" id="pekerjaan" name="pekerjaan" class="input input-bordered w-full bg-transparent" value="{{ $kt->pekerjaan }}" required>
                            </div>
                            <div class="mb-4">
                                <label for="status_perkawinan" class="block text-[0.9rem] font-semibold">Status Perkawinan</label>
                                <select id="status_perkawinan" name="status_perkawinan" class="select select-bordered w-full bg-transparent" required>
                                    <option value="Belum Menikah" {{ $kt->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ $kt->status_perkawinan == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Cerai" {{ $kt->status_perkawinan == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="kartu_keluarga_id" class="block text-[0.9rem] font-semibold">Kartu Keluarga</label>
                                <select id="kartu_keluarga_id" name="kartu_keluarga_id" class="select select-bordered w-full bg-transparent" required>
                                    <option value="">Pilih Kartu Keluarga</option>
                                    @foreach($kartu_keluarga as $kk)
                                        <option value="{{ $kk->id }}" {{ $kt->kartu_keluarga_id == $kk->id ? 'selected' : '' }}>
                                            {{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-action">
                                <button type="submit" class="btn text-white btn-primary">Simpan</button>
                                <label for="edit-modal-{{ $kt->id }}" class="btn text-white">Batal</label>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
