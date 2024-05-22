<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Mahasiswa, Dosen, ItemBerkas, Periode, User};

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
            $periode = Periode::where('status', 1)->first();
            return view('admin.student.dashboard_student', compact('data', 'periode'));
        } elseif (Auth::user()->role == 'dosen') {
            $data = Dosen::findOrFail(Auth::user()->dosen->id);
            $user = $data->User;
            $mahasiswas = Mahasiswa::where('dosen_id', $data->id)->get();
            $periodeIds = $mahasiswas->pluck('periode_id');
            $periode = Periode::findOrFail($periodeIds->first());
            $template_berkas = $periode->templateBerkas;
            $itemBerkas = ItemBerkas::where('template_berkas_id', $template_berkas->id)->get();
            return view('admin.dosen.dashboard_dosen', compact('data', 'user', 'mahasiswas', 'periode', 'template_berkas', 'itemBerkas'));
        }
    }
}
