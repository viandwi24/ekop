<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticCooperative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'village',
        'districts',
        'active',
        'type',
        'group',
    ];

    protected $casts = [
        // 'active' => 'boolean',
    ];
}
