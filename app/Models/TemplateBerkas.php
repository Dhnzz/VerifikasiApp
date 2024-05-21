<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function periodes(): BelongsToMany{
        return $this->belongsToMany(Periode::class, 'periode_template');
    }

    public function itemBerkas(): HasMany{
        return $this->hasMany(ItemBerkas::class);
    }
}
