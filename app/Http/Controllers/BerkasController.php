<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use Illuminate\Http\Request;


class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Berkas::all();
        return view('berkas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('berkas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Berkas::create($request->all());
        return redirect()->route('berkas.index')->with('success', 'Data berkas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $id)
    {
        $berka = Berkas::findOrFail($id);
        return view('berkas.show', compact("berka"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berkas $id)
    {
        $berka = Berkas::findOrFail($id);
        return view('berkas.edit', compact("berka"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berkas $id)
    {
        $berka = Berkas::findOrFail($id);
        $berka->update($request->all());
        return redirect()->route('berkas.index')->with('success', 'Data berkas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berkas $id)
    {
        $berka = Berkas::findOrFail($id);
        $berka->delete();
        return redirect()->route('berkas.index')->with('success', 'Data berkas berhasil dihapus!');
    }
}
