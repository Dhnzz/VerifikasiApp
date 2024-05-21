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
        $itemBerkas = ItemBerkas::all();
        return view('itemberkas.index', compact('itemBerkas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('itemberkas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return dd($request);
        $validatedData = $request->validate([
            "nama" => "required|string|max:255",
            'template_berkas_id' => 'required|exists:template_berkas,id',
        ]);

        foreach ($validatedData as $itemData) {
            return $itemData;
            # code...
            ItemBerkas::create($itemData);
        }

        return redirect()->route('itemberkas.index')->with('success', 'Data item berkas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(ItemBerkas $itemBerkas)
    public function show($id)
    {
        $itemberkas = ItemBerkas::findOrFail($id);
        return view('itemberkas.show', compact("itemberkas"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $itemberkas = ItemBerkas::findOrFail($id);
        return view('itemberkas.show', compact("itemberkas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $itemBerkas = ItemBerkas::findOrFail($id);
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            'template_berkas_id' => 'required|exists:template_berkas,id',
        ]);

        $itemBerkas->update($validatedData);
        return redirect()->route('itemberkas.index')->with('success', 'Data item berkas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemBerkas $id)
    {
        $itmberka = ItemBerkas::findOrFail($id);
        $itmberka->delete();
        return redirect()->route('itemberkas.index')->with('success', 'Data item berkas berhasil dihapus!');
    }
}
