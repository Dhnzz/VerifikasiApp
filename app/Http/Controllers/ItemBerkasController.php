<?php

namespace App\Http\Controllers;

use App\Models\ItemBerkas;
use App\Models\TemplateBerkas;
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
    public function create($id)
    {
        $data = TemplateBerkas::findOrFail($id);
        return view('admin.superadmin.template.manajemen_berkas', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return dd($request);
        // return dd($request->all());
        // $validatedData = $request->validate([
        //     "nama" => "required|string|max:255",
        //     'template_berkas_id' => 'required|exists:template_berkas,id',
        // ]);

        $data = $request->all();
        foreach ($data['name'] as $index => $name) {
            $template_berkas_id = $data['template_berkas_id'][$index];
            ItemBerkas::create([
                'name' => $name,
                'template_berkas_id' => $template_berkas_id
            ]);
        }

        return redirect()->route('template.index')->with('success', 'Data item berkas berhasil ditambahkan!');
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
        // $validatedData = $request->validate([
        //     "name" => "required|string|max:255",
        //     'template_berkas_id' => 'required|exists:template_berkas,id',
        // ]);

        $data = $request->all();
        foreach ($data['name'] as $index => $name) {
            $template_berkas_id = $data['template_berkas_id'][$index];
            $itemBerkas = ItemBerkas::where('template_berkas_id', $template_berkas_id)->first();
            if ($itemBerkas) {
                $itemBerkas->update([
                    'name' => $name
                ]);
            }
        }
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
