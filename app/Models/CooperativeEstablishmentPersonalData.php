<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeEstablishmentPersonalData extends Model
{
    use HasFactory;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'cooperative_establishment_personal_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function confirm_assistance()
    {
        return $this->hasOne(CooperativeEstablishmentConfirmAssistance::class, 'personal_data_id');
    }
}
