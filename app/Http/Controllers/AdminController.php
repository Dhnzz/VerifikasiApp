<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Mahasiswa, Dosen};

class AdminController extends Controller
{
    public function index()
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        return view('admin.superadmin.dashboard_superadmin', compact('jumlahMahasiswa', 'jumlahDosen'));
    }

    public function mahasiswa()
    {
        $data = Mahasiswa::get();
        return view('admin.student_index');
    }

    public function dosen()
    {
        return view('admin.dosen_index');
    }
}
