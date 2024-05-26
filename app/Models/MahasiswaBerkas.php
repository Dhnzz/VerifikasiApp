<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBerkas extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa_berkas';
    protected $fillable = [
        'mahasiswa_id',
        'item_berkas_id',
        'berkas',
        'status'
    ];
}
