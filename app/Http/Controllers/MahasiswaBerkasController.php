<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaBerkas;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MahasiswaBerkas $mahasiswaBerkas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MahasiswaBerkas $mahasiswaBerkas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MahasiswaBerkas $mahasiswaBerkas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MahasiswaBerkas $mahasiswaBerkas)
    {
        //
    }
}
