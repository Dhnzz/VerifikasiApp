<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaBerkas extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa_berkas';
    protected $fillable = [
        'mahasiswa_id',
        'item_berkas_id',
        'berkas',
        'revisi',
        'status'
    ];

    public function mahasiswa(): BelongsTo{
        return $this->belongsTo(Mahasiswa::class);
    }

    public function item_berkas(): BelongsTo{
        return $this->belongsTo(ItemBerkas::class);
    }
}
