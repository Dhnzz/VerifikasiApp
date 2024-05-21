<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Dosen};

class DashboardController extends Controller
{
    public function admin()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
    }

    public function mahasiswa()
    {
        $data = Mahasiswa::all();
        return view('admin.superadmin.students', compact('data'));
    }

    public function dosen()
    {
        $data = Dosen::all();
        return view('admin.superadmin.dosen', compact('data'));
    }
}
