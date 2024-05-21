<?php

namespace App\Http\Controllers;

use App\Models\{Periode, User, Mahasiswa};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Periode::all();
        return view('admin.superadmin.periode.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.superadmin.periode.create');
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
    public function show(Periode $id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $id)
    {
        $periode = Periode::findOrFail($id);
        $periode->update($request->all());
        return redirect()->route('periode.edit')->with('success', 'Data periode berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Data periode berhasil dihapus!');
    }
}
