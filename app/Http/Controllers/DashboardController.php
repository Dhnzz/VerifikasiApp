<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Mahasiswa, Dosen, Periode, ItemBerkas, TemplateBerkas};
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $jumlahMahasiswa = Mahasiswa::count();
            $jumlahDosen = Dosen::count();
            return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
        } elseif (Auth::user()->role == 'mahasiswa') {
            $data = Mahasiswa::findOrFail(Auth::user()->mahasiswa->id);
            $registered = Periode::where('id', $data->periode_id)->get();
            $dosen = Dosen::find($data->dosen_id);
            $periode = Periode::where('status', '1')->get();
            return view('admin.student.dashboard_student', compact('data', 'periode', 'registered', 'dosen'));
        } elseif (Auth::user()->role == 'dosen') {
            $data = Dosen::findOrFail(Auth::user()->dosen->id);
            $user = $data->User;
            $mahasiswas = Mahasiswa::where('dosen_id', $data->id)->get();
            $periodeIds = $mahasiswas->pluck('periode_id');
            // $periode = Periode::findOrFail($periodeIds->first());
            $periode = Periode::where('status', "1")->get();
            // $template_berkas = $periode->templateBerkas;
            // $itemBerkas = ItemBerkas::where('template_berkas_id', $template_berkas->id)->get();
            // $tglAwal = Carbon::createFromFormat('Y-m-d', $periode->tgl_mulai);
            // $tglAkhir = Carbon::createFromFormat('Y-m-d', $periode->tgl_berakhir);
            // $timeRangeDuration = intval($tglAwal->diffInMonths($tglAkhir));
            // if ($tglAwal->isSameMonth($tglAkhir) && $tglAwal->isSameYear($tglAkhir)) {
            //     $timeRangeDuration = 1;
            // }
            // $rangeFormat = $timeRangeDuration . ' Bulan';
            return view('admin.dosen.dashboard', compact('data', 'user', 'mahasiswas', 'periode'));
        } elseif (Auth::user()->role == 'kajur') {
            $Mahasiswa = Mahasiswa::all();
            $jumlahMahasiswa = $Mahasiswa->count();
            $dosenSi = Dosen::where('prodi', 'si')->first();
            $dosenPti = Dosen::where('prodi', 'pti')->first();
            $jumlahDosen = Dosen::count();
            $mahasiswaSI = Mahasiswa::where('prodi', 'Sistem Informasi')->count();
            $mahasiswaPTI = Mahasiswa::where('prodi', 'Pendidikan Teknologi Informasi')->count();

            // dd($mahasiswaPTI);
            return view('admin.kajur.kajur_dashboard', compact('jumlahMahasiswa', 'jumlahDosen', 'mahasiswaSI', 'mahasiswaPTI', 'dosenSi', 'dosenPti'));
        } else if (Auth::user()->role == 'kaprodi') {
            return view('admin.kaprodi.kaprodi_dashboard');
        }
    }
}
