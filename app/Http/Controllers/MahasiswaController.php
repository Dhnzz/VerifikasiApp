<?php

namespace App\Http\Controllers;

use App\Exports\ExportMahasiswa;
use App\Imports\ImportMahasiswa;
use App\Models\ItemBerkas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaBerkas;
use App\Models\Periode;
use App\Models\TemplateBerkas;
use App\Models\User;
use App\Models\Dosen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
            $prodi = 'si';
        } elseif ($nimProdi == '24') {
            $prodi = 'pti';
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

    public function pengajuan(Request $request)
    {
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $mahasiswa->update([
            'status' => "1"
        ]);
        return redirect()->route('dosen.periode.show', $request->periode_id)->with('success', 'Mahasiswa Berhasil di ajukan!');
    }

    public function izinPenjadwalan($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'status' => '2'
        ]);
        return redirect()->route('kaprodi.report.report')->with('success', 'Mahasiswa ' . $mahasiswa->name . ' diizinkan untuk  penjadwalan');
    }

    public function resetDataMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswaBerkas = MahasiswaBerkas::where('mahasiswa_id', $id)->get();
        foreach ($mahasiswaBerkas as $berkas) {
            if (Storage::disk('public')->exists('upload/' . $berkas->berkas)) {
                Storage::disk('public')->delete('upload/' . $berkas->berkas);
            }
            $berkasId = $berkas->id;
            $mahasiswaBerkasId = MahasiswaBerkas::findOrFail($berkasId);
            $mahasiswaBerkasId->delete();
        }
        $mahasiswa->update([
            'dosen_id' => null,
            'status' => "0",
            'periode_id' => null
        ]);
        return redirect()->route('dashboard')->with('success', 'Data mahasiswa berhasil direset');
    }

    public function report()
    {
        $dosen = Auth::user()->dosen; // Mendapatkan data dosen dari user yang sedang login
        $dosenId = $dosen->id; // Mendapatkan dosen_id
        $dosenProdi = $dosen->prodi; // Mendapatkan prodi dosen


        $mahasiswa = Mahasiswa::where('prodi', $dosenProdi)->where('status', '1')->get();

        return view('admin.kaprodi.report.scheduling_report', compact('mahasiswa'));
    }

    public function reportKajur()
    {
        $mahasiswa = Mahasiswa::where([
            'status' => '2'
        ])->get();
        return view('admin.kajur.report.scheduling_report', compact('mahasiswa'));
    }

    public function detailReport($id)
    {
        $data = Mahasiswa::findOrFail($id);
        return view('admin.kaprodi.report.scheduling_report_details', compact('data'));
    }

    public function reportDetail($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('admin.kajur.report.scheduling_report_details', compact('mahasiswa'));
    }

    public function downloadXlsx()
    {
        // Ambil tanggal saat ini dengan format yang diinginkan
    $currentDate = Carbon::now()->format('j-M-Y');

    // Gabungkan tanggal dengan nama file
    $fileName = 'mahasiswa_' . $currentDate . '.xlsx';

        return Excel::download(new ExportMahasiswa, $fileName);
    }

    public function importMahasiswa(Request $request){

        // Validasi file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Impor data mahasiswa
        try {
            Excel::import(new ImportMahasiswa, $request->file('excel_file'));

            return redirect()->back()->with('success', 'Data Mahasiswa berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    public function histori()
    {
        $dosenId = Auth::user()->dosen->id;
        $mahasiswa = Mahasiswa::where('dosen_id', $dosenId)->whereIn('status', ['1', '2'])->get();
        // dd($mahasiswa);
        return view('admin.dosen.histori', compact('mahasiswa'));
    }

    public function getHistori($id)
    {
        $mahasiswa = Mahasiswa::where([
            'id' => $id,
        ])->whereIn('status', ['1', '2'])->first();

        // $mahasiswaBerkasId = MahasiswaBerkas::where('mahasiswa_id', $mahasiswa->id)
        //     ->whereIn('item_berkas_id', $mahasiswa->itemBerkas->pluck('id'))
        //     ->get();
        return view('admin.dosen.get_detail_histori', compact('mahasiswa'));
    }

    public function rejectPengajuan(Request $request){

        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        foreach ($request->berkas_id as $berkas) {
            $berkas = MahasiswaBerkas::where('id', $berkas)->firstOrFail();
            $berkas->update([
                'status' => '0',
            ]);
        }
        $mahasiswa->update([
            'status' => "0"
        ]);
        return redirect()->route('dosen.mahasiswa.histori')->with('success', 'Mahasiswa Berhasil di Batalkan Pengajuan!');
    }

    public function importExcel(Request $request){
        
    }
}
