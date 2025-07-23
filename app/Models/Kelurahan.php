<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelurahan extends Model
{
    protected $table = 'ref_desa';
    protected $primaryKey = 'kode_desa';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = ['kode_desa', 'kode_kecamatan', 'nama_desa'];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kode_kecamatan', 'kode_kecamatan');
    }
}
