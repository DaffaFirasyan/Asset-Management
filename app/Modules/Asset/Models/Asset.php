<?php

namespace App\Modules\Asset\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'serial_number',
        'location',
        'status',
        'description',
    ];
}