<?php

namespace App\Http\Controllers;

use App\Models\{Periode, User, Mahasiswa};
use App\Models\PeriodeTemplate;
use App\Models\TemplateBerkas;
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
        $template_berkas = TemplateBerkas::get();
        // dd($template_berkas);
        return view('admin.superadmin.periode.create', compact('template_berkas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $periode = Periode::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_berakhir' => $request->tanggal_berakhir,
            'template_berkas_id' => $request->template_berkas_id,
            'status' => 1,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Periode baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periode = Periode::findOrFail($id);
        return view('admin.superadmin.periode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        $template_berkas = TemplateBerkas::get();
        return view('admin.superadmin.periode.edit', compact('periode', 'template_berkas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'tgl_mulai' => 'required|date',
        //     'tgl_berakhir' => 'required|date|after:tgl_mulai',
        // ]);

        $periode = Periode::findOrFail($id);
        $periode->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_berakhir' => $request->tanggal_berakhir,
            'template_berkas_id' => $request->template_berkas_id,
            // 'status' => 1,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Periode berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('admin.periode.index')->with('success', 'Data periode berhasil dihapus!');
    }

    public function periodeAktif(){
        $data = Mahasiswa::findOrFail(auth()->user()->mahasiswa->id);
        $aktif = Periode::where('status', 0)->get();
        return view('admin.student.periode.index', compact('data','aktif'));
    }
}
