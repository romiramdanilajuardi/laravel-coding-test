<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ktp extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ktp';

    protected $fillable = [
        'kartu_keluarga_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'pekerjaan',
        'status_perkawinan',
    ];

    // Relasi many-to-one dengan model KartuKeluarga
    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id');
    }
}
