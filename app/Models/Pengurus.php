<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengurus extends Model
{
    use SoftDeletes;

    protected $table = 'db_pengurus';
    protected $primaryKey = 'pengurus_id';
    public $incrementing = false; // karena pengurus_id varchar

    protected $fillable = [
        'pengurus_id',
        'ormas_id',
        'nik',
        'nama',
        'agama',
        'kewarganegaraan',
        'jk',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'telepon',
        'pekerjaan',
        'jabatan',
    ];

    protected $dates = [
        'tanggal_lahir',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relasi ke Ormas
    public function ormas()
    {
        return $this->belongsTo(Ormas::class, 'ormas_id');
    }
}
