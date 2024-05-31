<?php

namespace App\Exports;

use App\Models\mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportMahasiswa implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return mahasiswa::all();
    }

    public function map($invoice): array
    {
        $this->rowNumber++;

        $prodi = '';
        if ($invoice->prodi === 'si') {
            $prodi = 'Sistem Informasi';
        } elseif ($invoice->prodi === 'pti') {
            $prodi = 'Pendidikan Teknologi Informasi';
        } else {
            $prodi = 'Prodi Tidak Diketahui'; // Jika tidak ada kondisi yang sesuai, gunakan nilai asli
        }
        return [
            $this->rowNumber,
            $invoice->User->credential,
            $invoice->name,
            $prodi,
            $invoice->angkatan,
            $invoice->Dosen->name,
            $invoice->Periode->name,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'NIM',
            'Nama',
            'Program Studi',
            'Angkatan',
            'Dosen Verifikasi',
            'Periode',
        ];
    }
}
