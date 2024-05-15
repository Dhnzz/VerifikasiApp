<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'password' => ['required|min:8|max:255', 'confirmed', Password::defaults()],
            'angkatan' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        // Menyimpan credential dan password ke tabel users
        $user = User::create([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'mahasiswa'
        ]);
        $user->save();

        $mahasiswa = Mahasiswa::create([
            'name' => $validatedData['name'],
            'nim' => $validatedData['credential'],
            'user_id' => $user->id,
            'dosen_id' => null,
            'angkatan' => $validatedData['angkatan']
        ]);
        $mahasiswa->save();


        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $users = User::findOrFail($mahasiswa->id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'password' => ['required|min:8|max:255', 'confirmed', Password::defaults()],
            'angkatan' => 'required|string|max:255',
            'dosen_id' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $users->update([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $mahasiswa->update([
            'name' => $validatedData['name'],
            'nim' => $validatedData['credential'],
            'dosen_id' => $validatedData['dosen_id'],
            'angkatan' => $validatedData['angkatan']
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}
