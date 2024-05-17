<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama',
        'nomor',
        'jabatan',
        'departemen', // Make sure departemen is fillable
        'tanggal_masuk',
        'foto',
        'status',
    ];

    protected $attributes = [
        'departemen' => 'Default Departemen', // Set default value
    ];
}
