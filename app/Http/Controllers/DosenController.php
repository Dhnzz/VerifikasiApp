<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dosen::get();
        return view("dosen.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dosen.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        Mahasiswa::create($data);

        return redirect('dosen.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
