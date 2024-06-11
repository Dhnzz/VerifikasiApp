<?php

namespace App\Http\Controllers;

use App\Models\{MahasiswaBerkas, TemplateBerkas};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MahasiswaBerkasController extends Controller
{
    public function approve(Request $request)
    {
        $berkas = MahasiswaBerkas::where('item_berkas_id', $request->berkas_id)->where('mahasiswa_id', $request->mahasiswa_id)->firstOrFail();
        $berkas->update([
            'status' => '1',
        ]);
        // return dd($berkas);
        return redirect()->route('dosen.periode.show', $request->periode_id)->with('success', 'Berkas Berhasil di setujui!');
    }

    public function reject(Request $request)
    {
        $berkas = MahasiswaBerkas::where('item_berkas_id', $request->berkas_id)->where('mahasiswa_id', $request->mahasiswa_id)->firstOrFail();
        $berkas->update([
            'status' => '0',
            'revisi' => $request->revisi,
        ]);
        return redirect()->route('dosen.periode.show', $request->periode_id)->with('success', 'Berkas berhasil di tolak!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berkas_mahasiswa = MahasiswaBerkas::get();
        return view('admin.student.assign_file', compact('berkas_mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.superadmin.berkas_mahasiswa.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf'
        ]);
        $idItemBerkas = MahasiswaBerkas::where([
            'mahasiswa_id' => $request->mahasiswa_id,
            'item_berkas_id' => $request->item_berkas_id
        ])->first();
        $itemBerkas = MahasiswaBerkas::findOrFail($idItemBerkas->id);
        if (Storage::disk('public')->exists('upload') == true) {
            Storage::disk('public')->delete('upload/'.$itemBerkas->berkas);

            $file = $request->file('file');
            $fileName = time() . '_' . $request->mahasiswa_name . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('upload', $file, $fileName);
            $itemBerkas->update([
                'berkas' => $fileName,
                'revisi' => null
            ]);
            
            return redirect()->route('dashboard')->with('success', 'Data berkas mahasiswa berhasil diperbarui!');
        } else {
            $file = $request->file('file');
            $fileName = time() . '_' . $request->mahasiswa_name . '_' . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('upload', $file, $fileName);
            $itemBerkas->update([
                'berkas' => $fileName,
            ]);
            return redirect()->route('dashboard')->with('success', 'Data berkas mahasiswa berhasil diperbarui!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(MahasiswaBerkas $mahasiswaBerkas)
    {
        return view('admin.superadmin.berkas_mahasiswa.edit', compact('$mahasiswaBerkas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MahasiswaBerkas $mahasiswaBerkas)
    {
        return view('admin.superadmin.berkas_mahasiswa.edit', compact($mahasiswaBerkas));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MahasiswaBerkas $mahasiswaBerkas)
    {
        // $imageName = time().'.'.$request->image->extension();

        // $request->image->move(public_path('images'), $imageName);

        // /* Simpan informasi gambar ke database jika diperlukan, misalnya: */
        // $image = new Image();
        // $image->name = $imageName;
        // $image->path = 'images/' . $imageName;


        // $mahasiswaBerkas->update([
        //     'mahasiswa_id' => $request->mahasiswa_id,
        //     'item_berkas_id' => $request->item_berkas_id,
        //     'berkas' => $imageName,
        //     'status' => '0'
        // ]);

        return redirect()->route('admin.superadmin.berkas_mahasiswa.index')->with('success', 'Data berkas mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MahasiswaBerkas $mahasiswaBerkas)
    {
        $mahasiswaBerkas->delete();
        return redirect()->route('admin.superadmin.berkas_mahasiswa.index')->with('success', 'Data berkas mahasiswa berhasil dihapus!');
    }
}
