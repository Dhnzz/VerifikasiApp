<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Periode::all();
        return view('periode.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Periode::create($request->all());
        return redirect()->route('periode.index')->with('success', 'Data periode berhasil ditambahkan!');
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
        $priode->update($request->all()) ;
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
