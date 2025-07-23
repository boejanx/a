<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Legalitas extends Model
{
    use SoftDeletes;

    protected $table = 'db_legalitas';
    protected $primaryKey = 'legalitas_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'legalitas_id',
        'ormas_id',
        'bh_tbh',
        'notaris_nama',
        'notaris_nomor',
        'notaris_tanggal',
        'surat_permohonan_nomor',
        'surat_permohonan_tanggal',
        'sk_pengurus_nama',
        'sk_pengurus_nomor',
        'sk_pengurus_tanggal',
        'skko_no_ajuan',
        'skko_no_registrasi',
        'skko_tanggal_surat',
        'skko_tanggal_expired',
        'sk_kemenkumham_no',
        'sk_kemenkumham_tanggal',
        'doc_notaris',
        'doc_kepengurusan',
        'doc_kemenkumham',
        'doc_permohonan',
        'doc_skko',
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

    // Relasi ke model Ormas (jika diperlukan)
    public function ormas()
    {
        return $this->belongsTo(OrmasModel::class, 'ormas_id', 'ormas_id');
    }
}
