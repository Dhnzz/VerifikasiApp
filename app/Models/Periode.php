<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'tgl_mulai',
        'tgl_berakhir',
        'template_berkas_id',
    ];

    function TemplateBerkas() : HasMany {
        return $this->hasMany(TemplateBerkas::class);
    }
}
