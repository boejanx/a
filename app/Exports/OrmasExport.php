<?php

namespace App\Exports;

use App\Models\OrmasModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class OrmasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return OrmasModel::with(['pengurus', 'legalitas', 'kecamatan', 'kabupaten'])->get();
    }

    public function map($ormas): array
    {
        // Ambil pengurus pertama
        $pengurus = $ormas->pengurus->first();

        return [
            // Data ORMAS
            $ormas->ormas_id,
            $ormas->om_nama,
            $ormas->om_singkatan,
            $ormas->om_bidang,
            $ormas->om_jenis,
            "Jawa Tengah",
            $ormas->kabupaten?->nama_kabupaten ?? $ormas->om_alamat_kab,
            $ormas->kecamatan?->nama_kecamatan ?? $ormas->om_alamat_kec,
            $ormas->desas?->nama_desa ?? $ormas->om_alamat_kel,
            $ormas->om_alamat_jl,
            $ormas->om_visi,
            $ormas->om_misi,
            $ormas->om_telepon,
            $ormas->om_kta,
            $ormas->om_sumber_dana,
            $ormas->om_npwp,
            $ormas->om_asas_ciri,
            $ormas->om_lambang,
            $ormas->om_bendera,
            $ormas->om_stempel,
            $ormas->om_catatan,
            $ormas->created_at,
            $ormas->updated_at,

            // Data LEGALITAS
            $ormas->legalitas?->bh_tbh,
            $ormas->legalitas?->notaris_nama,
            $ormas->legalitas?->notaris_nomor,
            $ormas->legalitas?->notaris_tanggal,
            $ormas->legalitas?->surat_permohonan_nomor,
            $ormas->legalitas?->surat_permohonan_tanggal,
            $ormas->legalitas?->sk_pengurus_nama,
            $ormas->legalitas?->sk_pengurus_nomor,
            $ormas->legalitas?->sk_pengurus_tanggal,
            $ormas->legalitas?->skko_no_ajuan,
            $ormas->legalitas?->skko_no_registrasi,
            $ormas->legalitas?->skko_tanggal_surat,
            $ormas->legalitas?->skko_tanggal_expired,
            $ormas->legalitas?->sk_kemenkumham_no,
            $ormas->legalitas?->sk_kemenkumham_tanggal,
            $ormas->legalitas?->doc_notaris,
            $ormas->legalitas?->doc_kepengurusan,
            $ormas->legalitas?->doc_kemenkumham,
            $ormas->legalitas?->doc_permohonan,
            $ormas->legalitas?->doc_skko,

            // Data PENGURUS (ambil satu pengurus utama saja)
            $pengurus?->nik,
            $pengurus?->nama,
            $pengurus?->agama,
            $pengurus?->kewarganegaraan,
            $pengurus?->jk,
            $pengurus?->tempat_lahir,
            $pengurus?->tanggal_lahir,
            $pengurus?->status_perkawinan,
            $pengurus?->telepon,
            $pengurus?->pekerjaan,
            $pengurus?->jabatan, // jika ada jabatan di tabel pengurus
        ];
    }

    public function headings(): array
    {
        return [
            // ORMAS
            'ID ORMAS',
            'Nama Ormas',
            'Singkatan',
            'Bidang',
            'Jenis',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Alamat Jalan',
            'Visi',
            'Misi',
            'Telepon',
            'No. KTA',
            'Sumber Dana',
            'NPWP',
            'Asas & Ciri',
            'Lambang',
            'Bendera',
            'Stempel',
            'Catatan',
            'Created At',
            'Updated At',

            // LEGALITAS
            'Badan Hukum / TBH',
            'Nama Notaris',
            'No. Notaris',
            'Tanggal Notaris',
            'No. Surat Permohonan',
            'Tanggal Surat Permohonan',
            'Nama SK Pengurus',
            'No. SK Pengurus',
            'Tanggal SK Pengurus',
            'SKKO No. Ajuan',
            'SKKO No. Registrasi',
            'Tanggal SKKO',
            'Tanggal Expired SKKO',
            'No. SK Kemenkumham',
            'Tanggal SK Kemenkumham',
            'Doc Notaris',
            'Doc Kepengurusan',
            'Doc Kemenkumham',
            'Doc Permohonan',
            'Doc SKKO',

            // PENGURUS
            'NIK',
            'Nama Pengurus',
            'Agama',
            'Kewarganegaraan',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Perkawinan',
            'Telepon Pengurus',
            'Pekerjaan Pengurus',
            'Jabatan Pengurus',
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            if (null === $event->sheet) {
                return;
            }

            // Tanggal sekarang
            $tanggalSekarang = now()->format('d F Y, H:i') . ' WIB';

            // Isi text keterangan di A1
            $event->sheet->setCellValue('A1', 'Data digenerate melalui aplikasi SIOMAS pada tanggal: ' . $tanggalSekarang);

            // Option: kalau mau merge cell biar keterangannya lebar
            $event->sheet->mergeCells('A1:J1'); // J1 disesuaikan jumlah kolom kamu

            // Style: bold biar keterangan kelihatan
            $event->sheet->getStyle('A1')->getFont()->setBold(true);

            // Optional: kasih height row 1 biar ga kepotong
            $event->sheet->getRowDimension(1)->setRowHeight(25);
        },
    ];
}

}
