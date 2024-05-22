<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Periode extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'deskripsi',
        'tgl_mulai',
        'tgl_berakhir',
        'template_berkas_id',
        'status',
    ];

    public function templateBerkas(): BelongsTo{
        return $this->belongsTo(TemplateBerkas::class);
    }

    public function mahasiswa(): HasMany{
        return $this->hasMany(Mahasiswa::class);
    }
}
