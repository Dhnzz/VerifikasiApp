<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    function Periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    function ItemBerkas(): HasMany
    {
        return $this->hasMany(ItemBerkas::class);
    }
}
