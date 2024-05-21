<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'template_berkas_id'
    ];

    function TemplateBerkas(): BelongsTo
    {
        return $this->belongsTo(TemplateBerkas::class);
    }

    function Berkas(): BelongsTo
    {
        return $this->belongsTo(Berkas::class);
    }
}
