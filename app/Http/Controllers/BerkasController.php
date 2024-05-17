<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\ItemBerkas;
use App\Models\Mahasiswa;
use App\Models\TemplateBerkas;
use Illuminate\Http\Request;


class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berkas = Berkas::all();
        return view('berkas.index', compact('berkas'));
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
        $validatedData = $request->validate([
            'mahasiswa_id' => 'required|integer|exists:mahasiswas,id',
            'template_berkas_id' => 'required|integer|exists:template_berkas,id',
            'item_berkas' => 'required|array',
            'item_berkas.*.nama_berkas' => 'required|string|max:255',
            'item_berkas.*.file_berkas' => 'required|file|max:2048|mimes:pdf',
        ]);

        $mahasiswa = Mahasiswa::find($validatedData['mahasiswa_id']);
        $templateBerkas = TemplateBerkas::find($validatedData['template_berkas_id']);

        $berkasMahasiswa = Berkas::create([
            'mahasiswa_id' => $validatedData['mahasiswa_id'],
            'template_berkas_id' => $validatedData['template_berkas_id'],
        ]);

        foreach ($validatedData['item_berkas'] as $itemData) {
            $fileName = $itemData['file_berkas']->getClientOriginalName();
            $filePath = 'berkas-mahasiswa/' . $fileName;
            $itemData['file_berkas']->storeAs($filePath, $fileName);

            ItemBerkas::create([
                'berkas_mahasiswa_id' => $berkasMahasiswa->id,
                'nama_berkas' => $itemData['nama_berkas'],
                'file_berkas' => $filePath,
            ]);
        }

        return redirect()->route('berkas.index')->with('success', 'Berkas Mahasiswa baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berkas $id)
    {
        $berkasMahasiswa = Berkas::find($id);
        $mahasiswa = $berkasMahasiswa->mahasiswa;
        $templateBerkas = $berkasMahasiswa->templateBerkas;
        $itemBerkas = $berkasMahasiswa->itemBerkas;

        return view('berkas.show', compact('berkasMahasiswa', 'mahasiswa', 'templateBerkas', 'itemBerkas'));
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
