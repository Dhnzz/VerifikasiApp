<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berkas extends Model
{
    use HasFactory;

    protected $fillable = [
        "mahasiswa_id",
        "name",
        "status"
    ];

    function Mahasiswa(): BelongsTo {
        return $this->belongsTo(Mahasiswa::class);
    }
}
