<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provinsi extends Model
{
    protected $table = 'ref_provinsi';
    protected $primaryKey = 'kode_provinsi';
    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;
    protected $fillable = ['kode_provinsi', 'nama_provinsi'];

    public function kabupaten(): HasMany
    {
        return $this->hasMany(Kabupaten::class, 'kode_provinsi', 'kode_provinsi');
    }
}
