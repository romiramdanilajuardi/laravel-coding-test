<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ktp', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik')->unique(); // Nomor Induk Kependudukan
            $table->string('nama'); // Nama Penduduk
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');
            $table->uuid('kartu_keluarga_id');
            $table->foreign('kartu_keluarga_id')->references('id')->on('kartu_keluarga')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ktp');
    }
};
