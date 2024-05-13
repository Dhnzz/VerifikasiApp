<?php

namespace App\Http\Controllers;

use App\Models\ItemBerkas;
use Illuminate\Http\Request;

class ItemBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ItemBerkas::all();
        return view('itmberkas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('itmberkas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ItemBerkas::create($request->all());
        return redirect()->route('itmberkas.index')->with('success', 'Data item berkas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(ItemBerkas $itemBerkas)
    public function show(ItemBerkas $id)
    {
        $itmberka = ItemBerkas::findOrFail($id);
        return view('itmberkas.show', compact("itmberka"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemBerkas $id)
    {
        $itmberka = ItemBerkas::findOrFail($id);
        return view('itmberkas.edit', compact("itmberka"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemBerkas $id)
    {
        $itmberka = ItemBerkas::findOrFail($id);
        $itmberka->update($request->all());
        return redirect()->route('itmberkas.index')->with('success', 'Data item berkas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemBerkas $id)
    {
        $itmberka = ItemBerkas::findOrFail($id);
        $itmberka->delete();
        return redirect()->route('itmberkas.index')->with('success', 'Data item berkas berhasil dihapus!');
    }
}
