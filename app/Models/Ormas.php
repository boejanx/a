<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ormas extends Model
{
    protected $table = 'db_ormas';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_ormas',
        'akta_notaris',
        'sk_kemenkumham',
        'sk_ormas',
        'alamat_sekretariat',
        'kecamatan',
        'npwp',
        'nomor_skko',
        'nomor_reg',
        'tanggal_reg',
        'berlaku_skko',
        'ketua',
        'sekretaris',
        'bendahara',
        'bendahara_2',
        'telepon',
    ];

    // Optional: Format tanggal otomatis
    protected $dates = ['tanggal_reg', 'berlaku_skko'];
    protected $casts = [
    'berlaku_skko' => 'datetime',
    'tanggal_reg' => 'datetime',
];
}
