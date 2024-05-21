<?php

namespace App\Http\Controllers;

use App\Models\TemplateBerkas;
use Illuminate\Http\Request;

class TemplateBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TemplateBerkas::all();
        return view('admin.superadmin.template.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.superadmin.template.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
        ]);

        $validatedData['name'] .= ' ' . now()->format('d/m/Y');
        $tmpBerkas = TemplateBerkas::create($validatedData);
        $tmpBerkas->save();

        return redirect()->route('template.index')->with('success', 'Template Berkas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tmpBerkas = TemplateBerkas::findOrFail($id);
        return view('template-berkas.show', compact('tmpBerkas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tmpBerkas = TemplateBerkas::findOrFail($id);
        return view('template-berkas.show', compact('tmpBerkas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tmpBerkas = TemplateBerkas::findOrFail($id);
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
        ]);

        $tmpBerkas->update($validatedData);

        return redirect()->route('template-berkas.index')->with('success', 'Template Berkas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tmpBerkas = TemplateBerkas::findOrFail($id);
        $tmpBerkas->delete();

        return redirect()->route('template-berkas.index')->with('success', 'Template Berkas berhasil dihapus.');
    }
}
