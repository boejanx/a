<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefBidangKegiatan extends Model
{
    protected $table = 'ref_bidang_kegiatan';

    protected $fillable = ['nama'];

    public $timestamps = true;
}
