<?php

namespace App\Http\Controllers;

use App\Models\{Dosen, ItemBerkas, Periode, User, Mahasiswa};
use App\Models\MahasiswaBerkas;
use App\Models\PeriodeTemplate;
use App\Models\TemplateBerkas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return redirect()->route('kajur.periode.index')->with('success', 'Periode baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periode = Periode::findOrFail($id);
        $template_berkas = TemplateBerkas::findOrFail($periode->template_berkas_id);
        $itemBerkas = ItemBerkas::where('template_berkas_id', $template_berkas->id)->get();
        $tglAwal = Carbon::createFromFormat('Y-m-d', $periode->tgl_mulai);
        $tglAkhir = Carbon::createFromFormat('Y-m-d', $periode->tgl_berakhir);
        $timeRangeDuration = intval($tglAwal->diffInMonths($tglAkhir));
        if ($tglAwal->isSameMonth($tglAkhir) && $tglAwal->isSameYear($tglAkhir)) {
            $timeRangeDuration = 1;
        }
        $rangeFormat = $timeRangeDuration . ' Bulan';
        return view('admin.superadmin.periode.show', compact('periode', 'tglAwal', 'tglAkhir', 'template_berkas', 'itemBerkas', 'rangeFormat'));
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

        return redirect()->route('kajur.periode.index')->with('success', 'Periode berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('kajur.periode.index')->with('success', 'Data periode berhasil dihapus!');
    }

    public function changeStatus($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->update([
            'status' => ($periode->status == '1') ? '0' : '1',
        ]);
        return redirect()->route('kajur.periode.index')->with('success', 'Status periode berhasil diubah!');
    }
    // public function periodeAktif()
    // {
    //     $data = Mahasiswa::findOrFail(auth()->user()->mahasiswa->id);
    //     $aktif = Periode::where('status', 0)->get();
    //     return view('admin.student.periode.index', compact('data', 'aktif'));
    // }

    public function showDosen($id)
    {
        $dosen = Dosen::findOrFail(Auth::user()->dosen->id);
        $periode = Periode::findOrFail($id);
        $mahasiswas = $dosen->mahasiswa()->whereHas('periode', function ($query) use ($id) {
            $query->where(['periode_id' => $id, 'status' => "0"]);
        })->get();
        return view('admin.dosen.template_detail_periode', compact('periode', 'dosen', 'mahasiswas'));
    }

    public function getPeserta($id)
    {
        $peserta = Mahasiswa::where([
            'id' => $id,
            'status' => "0"
        ])->first();
        
        $mahasiswaBerkasId = MahasiswaBerkas::where('mahasiswa_id', $peserta->id)
            ->whereIn('item_berkas_id', $peserta->itemBerkas->pluck('id'))
            ->get();
        return view('admin.dosen.template_detail_mahasiswa', compact('peserta','mahasiswaBerkasId'));
    }
}
