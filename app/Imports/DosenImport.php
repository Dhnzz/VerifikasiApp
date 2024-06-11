<?php

namespace App\Imports;

use App\Models\{Dosen, User};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DosenImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
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

            // Lakukan validasi manual karena tidak ada request
            $validator = Validator::make([
                'credential' => $row['nidn'],
                'name' => $row['nama'],
            ], [
                'name' => 'required|max:255',
                'credential' => 'required|max:255|unique:users,credential',
            ]);

            if ($validator->fails()) {
                // Lewati baris ini jika validasi gagal
                continue;
            }

            $validatedData = $validator->validated();

            // Menyimpan credential dan password ke tabel users
            $user = User::create([
                'credential' => $validatedData['credential'],
                'email' => strtolower(preg_replace('/\s+/', '', $validatedData['name']) . '@dosen.informatika.ft.ung.ac.id'),
                'password' => Hash::make($validatedData['credential']),
                'role' => 'dosen'
            ]);

            // Menyimpan data mahasiswa
            Dosen::create([
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'prodi' => null
            ]);
        }
    }
}

