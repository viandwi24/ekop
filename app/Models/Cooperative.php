<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cooperative extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'nik',
        'legal_entity_number',
        'legal_entity_date',
        'legal_entity_approval',
        'cooperative_domicile',
        'notary',
        'npwp',
        'address',
        'phone_hp',
        'phone_company',
        'facsimile',
        'email',
        'website',
        'note',
        'status',
        'isbig',
        'approved_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'legal_entity_date' => 'date',
        'approved_at' => 'datetime',
        'status' => 'boolean',
        'isbig' => 'boolean',
    ];

    public function advocacy()
    {
        return $this->hasMany(AdvocacyPersonalData::class);
    }

    public function accompaniment()
    {
        return $this->hasMany(AccompanimentPersonalData::class);
    }
}
