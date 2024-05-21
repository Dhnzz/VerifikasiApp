<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Periode extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
        'tgl_mulai',
        'tgl_berakhir',
        'template_berkas_id',
    ];

    public function templateBerkas(): BelongsToMany{
        return $this->belongsToMany(TemplateBerkas::class, 'periode_template');
    }
}
