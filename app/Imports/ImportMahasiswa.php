<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class ImportMahasiswa implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Skip the first row (header)
        $isFirstRow = true;

        foreach ($rows as $row) {
            if ($isFirstRow) {
                $isFirstRow = false;
                continue; // Skip this iteration
            }

            // Menyesuaikan dengan struktur kolom di file excel
            $nimProdi = substr($row[1], 2, 2);
            $prodi = '';
            if ($nimProdi == '14') {
                $prodi = 'si';
            } elseif ($nimProdi == '24') {
                $prodi = 'pti';
            }

            // Lakukan validasi manual karena tidak ada request
            $validator = Validator::make([
                'name' => $row[0],
                'credential' => $row[1],
                'angkatan' => $row[2],
            ], [
                'name' => 'required|max:255',
                'credential' => 'required|max:255|unique:users,credential',
                'angkatan' => 'required|max:255',
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
