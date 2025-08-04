<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefJenisKelembagaan extends Model
{
    protected $table = 'ref_jenis_kelembagaan';

    protected $fillable = [ 'nama'];

    public $timestamps = true;
}
