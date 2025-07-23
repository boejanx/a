<?php

// database/seeders/RefJenisKelembagaanSeeder.php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefJenisKelembagaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('ref_jenis_kelembagaan')->insert([
            ['id' => 1, 'nama' => 'Lembaga Swadaya Masyarakat (LSM)'],
            ['id' => 2, 'nama' => 'Yayasan'],
            ['id' => 3, 'nama' => 'Perkumpulan'],
            ['id' => 4, 'nama' => 'Organisasi Kemasyarakatan Keagamaan'],
            ['id' => 5, 'nama' => 'Organisasi Profesi'],
            ['id' => 6, 'nama' => 'Organisasi Kepemudaan'],
            ['id' => 7, 'nama' => 'Paguyuban / Perkumpulan Kedaerahan'],
            ['id' => 8, 'nama' => 'Lembaga Adat'],
            ['id' => 9, 'nama' => 'Lembaga Sosial'],
            ['id' => 10, 'nama' => 'Lembaga Pendidikan Nonformal'],
            ['id' => 11, 'nama' => 'Organisasi Sosial Politik (Orsospol) non-partai'],
            ['id' => 12, 'nama' => 'Forum / Komunitas Masyarakat'],
            ['id' => 13, 'nama' => 'Organisasi Buruh / Serikat Pekerja'],
            ['id' => 14, 'nama' => 'Organisasi Wanita'],
            ['id' => 15, 'nama' => 'Organisasi Lingkungan Hidup'],
            ['id' => 16, 'nama' => 'Organisasi Bela Negara / Patriotik'],
            ['id' => 17, 'nama' => 'Lembaga Keagamaan Lokal / Majelis'],
            ['id' => 18, 'nama' => 'Lembaga Mitra Pemerintah Daerah'],
            ['id' => 99, 'nama' => 'Lainnya (diisi manual)'],
        ]);
    }
}

