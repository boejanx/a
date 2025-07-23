<?php

// database/migrations/xxxx_xx_xx_create_ref_jenis_kelembagaan_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefJenisKelembagaan extends Migration
{
    public function up()
    {
        Schema::create('ref_jenis_kelembagaan', function (Blueprint $table) {
            $table->id(); // kode ID dari 1-99
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ref_jenis_kelembagaan');
    }
}
