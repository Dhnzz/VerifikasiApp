<?php

namespace App\Http\Controllers;

use App\Models\{MahasiswaBerkas, TemplateBerkas};
use Illuminate\Http\Request;

class MahasiswaBerkasController extends Controller
{
    public function approve(Request $request, $id)
    {
        $berkas = MahasiswaBerkas::findOrFail($id);
        $berkas->update([
            'status' => '1',
        ]);
        // return dd($berkas);
        return redirect()->route('dosen.periode.show', $request->periode_id)->with('success', 'Berkas Berhasil di setujui!');;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berkas_mahasiswa = MahasiswaBerkas::get();
        return view('admin.student.assign_file',compact('berkas_mahasiswa'));
    }

    public function byTemplateBerkas()
    {
        $user = Mahasiswa::where('user_id', $request->auth()->user()->id())->first();
        $berkas_mahasiswa = TemplateBerkas::where('periode_id', $user->periode_id)->with('itemBerkas')->get();
        return view('admin.student.assign_file',compact('berkas_mahasiswa'));
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
        if ($request->hasFile('file')) {
            // put image in the public storage
           $filePath = Storage::disk('public')->put('images/posts/featured-images', request()->file('file'));
           $file = $filePath;
           
           $data = MahasiswaBerkas::create([
               'mahasiswa_id' => $request->mahasiswa_id,
               'item_berkas_id' => $request->item_berkas_id,
               'berkas' => $file,
               'status' => '0'
           ]);
    
           return redirect()->route('admin.superadmin.berkas_mahasiswa.index')->with('success', 'Data berkas mahasiswa berhasil ditambahkan!');
       }

    }

    /**
     * Display the specified resource.
     */
    public function show(MahasiswaBerkas $mahasiswaBerkas)
    {
        return view('admin.superadmin.berkas_mahasiswa.edit',compact('$mahasiswaBerkas'));
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
        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        /* Simpan informasi gambar ke database jika diperlukan, misalnya: */
        $image = new Image();
        $image->name = $imageName;
        $image->path = 'images/' . $imageName;
    

        $mahasiswaBerkas->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'item_berkas_id' => $request->item_berkas_id,
            'berkas' => $imageName,
            'status' => '0'
        ]);

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
