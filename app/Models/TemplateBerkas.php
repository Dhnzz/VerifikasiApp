<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TemplateBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];

    public function periodes(): BelongsToMany{
        return $this->belongsToMany(Periode::class, 'periode_template');
    }

    public function itemBerkas(): BelongsToMany{
        return $this->belongsToMany(ItemBerkas::class, 'template_item');
    }
}
