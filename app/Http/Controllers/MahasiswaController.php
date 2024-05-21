<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswa::get();
        return view('admin.superadmin.mahasiswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.superadmin.mahasiswa.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'angkatan' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        // Menyimpan credential dan password ke tabel users
        $user = User::create([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['credential']),
            'role' => 'mahasiswa'
        ]);
        $user->save();

        $mahasiswa = Mahasiswa::create([
            'name' => $validatedData['name'],
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
        $data = Mahasiswa::findOrFail($id);
        return view('admin.superadmin.mahasiswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return view('admin.superadmin.mahasiswa.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential,' . $user->id,
            'angkatan' => 'required|string|max:255',
            // 'dosen_id' => 'required|exists:dosen,id',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $user->update([
            'credential' => $validatedData['credential'],
        ]);
        $mahasiswa->update([
            'name' => $validatedData['name'],
            'angkatan' => $validatedData['angkatan']
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function updatePass(Request $request, $id){
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa);
        $validatedData = $request->validate([
            'password' => 'required|string|max:255',
        ]);
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('mahasiswa.index')->with('success','Password berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $mahasiswa->delete();
        $user->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}
