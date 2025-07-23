<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OrmasModel extends Model
{
    use SoftDeletes;

    protected $table = 'db_profil_ormas';
    protected $primaryKey = 'ormas_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ormas_id',
        'om_nama',
        'om_singkatan',
        'om_bidang',
        'om_jenis',
        'om_alamat_prov',
        'om_alamat_kab',
        'om_alamat_kec',
        'om_alamat_kel',
        'om_alamat_jl',
        'om_visi',
        'om_misi',
        'om_telepon',
        'om_kta',
        'om_sumber_dana',
        'om_npwp',
        'om_asas_ciri',
        'om_lambang',
        'om_bendera',
        'om_stempel',
        'om_catatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
