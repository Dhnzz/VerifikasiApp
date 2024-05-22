<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Dosen};

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
    }
}
