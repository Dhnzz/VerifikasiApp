<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class ItemBerkas extends Model
{
    use HasFactory;
    protected $fillable = [
      'nama',
      'template_berkas_id'  
    ];
    
    public function templateBerkas(): BelongsToMany{
        return $this->belongsToMany(TemplateBerkas::class, 'template_item');
    }
    public function mahasiswas(): BelongsToMany{
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_berkas');
    }
}
