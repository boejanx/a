<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    protected $table = 'ref_kecamatan';
    protected $primaryKey = 'kode_kecamatan';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = ['kode_kecamatan', 'kode_kabupaten', 'nama_kecamatan'];

    public function kabupaten(): BelongsTo
    {
        return $this->belongsTo(Kabupaten::class, 'kode_kabupaten', 'kode_kabupaten');
    }

    public function kelurahan(): HasMany
    {
        return $this->hasMany(Kelurahan::class, 'kode_kecamatan', 'kode_kecamatan');
    }
}
