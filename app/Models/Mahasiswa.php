<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "dosen_id",
        "name",
        "prodi",
        "angkatan",
        "periode_id"
    ];

    function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function Dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function itemBerkas(): BelongsToMany
    {
        return $this->belongsToMany(ItemBerkas::class, 'mahasiswa_berkas');
    }


    public function berkas_mahasiswa(): HasMany
    {
        return $this->hasMany(MahasiswaBerkas::class);
    }
}
