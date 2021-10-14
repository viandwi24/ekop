<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CooperativeEstablishmentConfirmAssistance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'personal_data_id',
        'submission_at',
        'mentoring_at',
        'location',
        'client_name',
        'participant',
        'media',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'submission_at' => 'date',
        'mentoring_at' => 'date',
        'participant' => 'integer',
    ];

    public function personal_data()
    {
        return $this->belongsTo(CooperativeEstablishmentPersonalData::class, 'personal_data_id');
    }
}
