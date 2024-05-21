<?php

namespace App\Http\Controllers;

use App\Models\{Dosen, Mahasiswa, User};
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
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        // Menyimpan credential dan password ke tabel users
        $user = User::create([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['credential']),
            'role' => 'dosen'
        ]);
        $user->save();

        $dosen = Dosen::create([
            'name' => $validatedData['name'],
            'user_id' => $user->id
        ]);
        $dosen->save();


        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
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
        $dosen = Dosen::findOrFail($id);
        return view('admin.superadmin.dosen.edit', compact('dosen'));
    }

    /**
     * Memperbarui data dosen di database.
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $users = User::findOrFail($dosen->id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $users->update([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $dosen->update([
            'nama' => $validatedData['name'],
            'nipdn' => $validatedData['credential']
        ]);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui.');
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

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
