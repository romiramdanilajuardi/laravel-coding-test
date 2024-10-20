<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KartuKeluarga extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kartu_keluarga';

    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];

    // Relasi one-to-many dengan model KTP
    public function ktp()
    {
        return $this->hasMany(Ktp::class);
    }
}
