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
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date|after:tgl_mulai',
        ]);

        Periode::create($validatedData);

        return redirect()->route('periode.index')->with('success', 'Periode baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periode = Periode::findOrFail($id);
        $templateBerkas = $periode->templateBerkas;

        return view('periode.show', compact('periode', 'templateBerkas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        return view('periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date|after:tgl_mulai',
        ]);

        $periode = Periode::findOrFail($id);
        $periode->update($validatedData);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Data periode berhasil dihapus!');
    }
}
