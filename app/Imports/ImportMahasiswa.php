<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMahasiswa implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Skip the first row (header)
        // $isFirstRow = true;

        foreach ($rows as $row) {
            // if ($isFirstRow) {
            //     $isFirstRow = false;
            //     continue; // Skip this iteration
            // }

            // Menyesuaikan dengan struktur kolom di file excel
            $nimProdi = substr($row['nim'], 2, 2);
            $prodi = '';
            if ($nimProdi == '14') {
                $prodi = 'si';
            } elseif ($nimProdi == '24') {
                $prodi = 'pti';
            }

            // Lakukan validasi manual karena tidak ada request
            $validator = Validator::make([
                'credential' => $row['nim'],
                'name' => $row['nama'],
                'angkatan' => $row['angkatan'],
            ], [
                'name' => 'required',
                'credential' => 'required',
                'angkatan' => 'required',
            ]);

            if ($validator->fails()) {
                // Lewati baris ini jika validasi gagal
                continue;
            }

            $validatedData = $validator->validated();

            // Menyimpan credential dan password ke tabel users
            $user = User::create([
                'credential' => $validatedData['credential'],
                'password' => Hash::make($validatedData['credential']),
                'role' => 'mahasiswa'
            ]);

            // Menyimpan data mahasiswa
            Mahasiswa::create([
                'name' => $validatedData['name'],
                'user_id' => $user->id,
                'dosen_id' => null,
                'prodi' => $prodi,
                'angkatan' => $validatedData['angkatan']
            ]);
        }
    }
}
