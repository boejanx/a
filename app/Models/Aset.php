<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Aset extends Model
{
    use SoftDeletes;

    protected $table = 'db_aset';
    protected $primaryKey = 'aset_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'aset_id',
        'ormas_id',
        'aset_nama',
        'aset_jumlah',
        'aset_kepemilikan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->aset_id = (string) Str::uuid();
        });
    }

    public function ormas()
    {
        return $this->belongsTo(Ormas::class, 'ormas_id');
    }
}
