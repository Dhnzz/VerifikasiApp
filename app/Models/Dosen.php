<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "name",
        "prodi",
    ];

    function User(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    function Mahasiswa(): HasMany {
        return $this->hasMany(Mahasiswa::class);
    }
}
