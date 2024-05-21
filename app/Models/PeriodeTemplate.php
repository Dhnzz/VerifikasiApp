<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTemplate extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode_id',
        'template_berkas_id'
    ];
}
