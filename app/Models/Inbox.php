<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Inbox extends Model
{
    use SoftDeletes;

    protected $table = 'db_inbox';
    protected $primaryKey = 'inbox_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'inbox_id',
        'inbox_nama',
        'inbox_whatsapp',
        'inbox_perihal',
        'inbox_isi',
        'inbox_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->inbox_id = (string) Str::uuid();
        });
    }

}
