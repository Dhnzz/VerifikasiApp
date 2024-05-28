<?php

namespace App\Http\Controllers;

use App\Models\{Dosen, User};
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DosenController extends Controller
{
    /**
     * Menampilkan daftar dosen.
     */
    public function index()
    {
        $data = Dosen::get();
        return view('admin.superadmin.dosen.index', compact('data'));
    }

    /**
     * Menampilkan form untuk membuat dosen baru.
     */
    public function create()
    {
        return view('admin.superadmin.dosen.create');
    }

    /**
     * Menyimpan dosen baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'role' => 'required|string'
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        // Menyimpan credential dan password ke tabel users
        $user = User::create([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['credential']),
            'role' => $validatedData['role'],
        ]);
        $user->save();

        $dosen = Dosen::create([
            'name' => $validatedData['name'],
            'user_id' => $user->id
        ]);
        $dosen->save();


        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Menampilkan dosen berdasarkan ID.
     */
    public function show($id)
    {
        $data = Dosen::findOrFail($id);
        return view('admin.superadmin.dosen.show', compact('data'));
    }

    /**
     * Menampilkan form untuk mengedit dosen.
     */
    public function edit($id)
    {
        $data = Dosen::findOrFail($id);
        return view('admin.superadmin.dosen.edit', compact('data'));
    }

    /**
     * Memperbarui data dosen di database.
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential,' . $user->id,
            'role' => 'required|string'
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $user->update([
            'credential' => $validatedData['credential'],
            'role' => $validatedData['role'],
        ]);
        $dosen->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function updatePass(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        $validatedData = $request->validate([
            'password' => 'required|string|max:255',
        ]);
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('admin.dosen.index')->with('success', 'Password berhasil diubah');
    }

    /**
     * Menghapus dosen dari database.
     */
    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::findOrFail($dosen->user_id);
        $dosen->delete();
        $user->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }

    public function chooseKaprodi()
    {
        $users = User::whereIn('role', ['kaprodi', 'dosen'])
            ->whereHas('dosen')
            ->get();
        return view('admin.kajur.kaprodi_entries', compact('users'));
    }

    public function selectKaprodi(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $kaprodiBefore = User::leftJoin('dosens', 'users.id', '=', 'dosens.user_id')
            ->where([
                'role' => 'kaprodi',
                'prodi' => $request->prodi
            ])->first();


        if ($kaprodiBefore != null) {
            $kaprodiBeforeId = User::findOrFail($kaprodiBefore->user_id);
            $cekMahasiswa = $kaprodiBeforeId->Dosen->Mahasiswa;
            if ($cekMahasiswa->count() > 0) {
                foreach ($cekMahasiswa as $mahasiswa) {
                    $role = 'dosen'; // Ganti dengan peran yang ingin Anda filter, misalnya 'dosen', 'kaprodi', atau 'kajur'

                    $dosen = Dosen::withCount('mahasiswa')
                        ->whereHas('user', function ($query) use ($role) {
                            $query->where('role', $role);
                        })
                        ->orderBy('mahasiswa_count', 'asc')
                        ->first();
                    $ubahDosen = Mahasiswa::findOrFail($mahasiswa->id);
                    $ubahDosen->update([
                        'dosen_id' => $dosen->id,
                    ]);
                }
            }
            $kaprodiBeforeId->update([
                'role' => 'dosen'
            ]);
            $kaprodiBeforeId->Dosen->update([
                'prodi' => null
            ]);

            $user->update([
                'role' => 'kaprodi'
            ]);
            $user->Dosen->update([
                'prodi' => $request->prodi
            ]);
        } else {
            $user->update([
                'role' => 'kaprodi'
            ]);
            $user->Dosen->update([
                'prodi' => $request->prodi
            ]);
        }
        return redirect()->route('kajur.kaprodi.choose')->with('success', 'Data dosen diubah.');
    }
}
