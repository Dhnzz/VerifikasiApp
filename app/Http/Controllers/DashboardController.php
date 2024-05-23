<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Mahasiswa, Dosen, Periode, ItemBerkas, TemplateBerkas};

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $jumlahMahasiswa = Mahasiswa::count();
            $jumlahDosen = Dosen::count();
            return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
        }elseif(Auth::user()->role == 'mahasiswa'){
            $data = Mahasiswa::findOrFail(Auth::user()->mahasiswa->id);
            $registered = Periode::where('id', $data->periode_id)->get();
            $dosen = Dosen::find($data->dosen_id);
            $periode = Periode::where('status', '1')->get(); 
            return view('admin.student.dashboard_student', compact('data', 'periode', 'registered', 'dosen'));
        }
    }
}
