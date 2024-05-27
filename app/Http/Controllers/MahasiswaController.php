<?php

namespace App\Http\Controllers;

use App\Models\ItemBerkas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaBerkas;
use App\Models\Periode;
use App\Models\TemplateBerkas;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswa::get();
        return view('admin.superadmin.mahasiswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.superadmin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nimProdi = substr($request->credential, 2, 2);
        $prodi = '';
        if ($nimProdi == '14') {
            $prodi = 'Sistem Informasi';
        } elseif ($nimProdi == '24') {
            $prodi = 'Pendidikan Teknologi Informasi';
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential',
            'angkatan' => 'required|string|max:255',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);
        // Menyimpan credential dan password ke tabel users
        $user = User::create([
            'credential' => $validatedData['credential'],
            'password' => Hash::make($validatedData['credential']),
            'role' => 'mahasiswa'
        ]);
        $user->save();

        $mahasiswa = Mahasiswa::create([
            'name' => $validatedData['name'],
            'user_id' => $user->id,
            'dosen_id' => null,
            'prodi' => $prodi,
            'angkatan' => $validatedData['angkatan']
        ]);
        $mahasiswa->save();


        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return view('admin.superadmin.mahasiswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return view('admin.superadmin.mahasiswa.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'credential' => 'required|string|max:255|unique:users,credential,' . $user->id,
            'angkatan' => 'required|string|max:255',
            // 'dosen_id' => 'required|exists:dosen,id',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $user->update([
            'credential' => $validatedData['credential'],
        ]);
        $mahasiswa->update([
            'name' => $validatedData['name'],
            'angkatan' => $validatedData['angkatan']
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function updatePass(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa);
        $validatedData = $request->validate([
            'password' => 'required|string|max:255',
        ]);
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Password berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::findOrFail($mahasiswa->user_id);
        $mahasiswa->delete();
        $user->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }

    public function daftar(Request $request, $idMahasiswa, $idPeriode)
    {
        $mahasiswa = Mahasiswa::findOrFail($idMahasiswa);
        $role = 'dosen'; // Ganti dengan peran yang ingin Anda filter, misalnya 'dosen', 'kaprodi', atau 'kajur'

        $dosen = Dosen::withCount('mahasiswa')
            ->whereHas('user', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->orderBy('mahasiswa_count', 'asc')
            ->first();
        $periode = Periode::where('id', $idPeriode)->first();
        $itemBerkas = ItemBerkas::where('template_berkas_id', $periode->template_berkas_id)->get();
        $mahasiswa->update([
            'periode_id' => $idPeriode,
            'dosen_id' => $dosen->id
        ]);
        foreach ($itemBerkas as $item => $value) {
            MahasiswaBerkas::create([
                'item_berkas_id' => $value->id,
                'mahasiswa_id' => $mahasiswa->id,
                'status' => '0'
            ]);
            // $mahasiswaBerkas->save();
        }
        return redirect()->route('dashboard')->with('success', 'Berhasil daftar periode');
    }

    public function pengajuan(Request $request){
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->update([
            'status' => 1
        ]);
        return redirect()->route('dosen.periode.show', $request->periode_id)->with('success', 'Mahasiswa Berhasil di ajukan!');
    }
}
