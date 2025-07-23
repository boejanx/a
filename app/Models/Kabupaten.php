<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
    protected $table = 'ref_kabupaten';
    protected $primaryKey = 'kode_kabupaten';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = ['kode_kabupaten', 'kode_provinsi', 'nama_kabupaten'];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(Provinsi::class, 'kode_provinsi', 'kode_provinsi');
    }

    public function kecamatan(): HasMany
    {
        return $this->hasMany(Kecamatan::class, 'kode_kabupaten', 'kode_kabupaten');
    }
}
