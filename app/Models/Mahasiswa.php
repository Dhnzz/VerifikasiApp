<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable =[
        "user_id",
        "dosen_id",
        "name",
        "nim",
        "batch"
    ];

    function User() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    function Dosen(): BelongsTo {
        return $this->belongsTo(Dosen::class);
    }

    function Berkas(): HasMany {
        return $this->hasMany(Berkas::class);
    }
}
