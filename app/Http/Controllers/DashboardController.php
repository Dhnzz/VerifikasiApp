<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Mahasiswa, Dosen};

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $jumlahMahasiswa = Mahasiswa::count();
            $jumlahDosen = Dosen::count();
            return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
        // }elseif(Auth::user()->role == 'dosen'){
        //     return view('dosen.dosen.dashboard_dosen');
        }elseif(Auth::user()->role == 'mahasiswa'){
            return view('admin.student.dashboard_student');
        }
    }
}
