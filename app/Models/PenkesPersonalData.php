<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenkesPersonalData extends Model
{
    use HasFactory;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'penkes_personal_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'health_score',
        'file_path',
        'file_name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'health_score' => 'float',
    ];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }

    public function confirm_assistance()
    {
        return $this->hasOne(PenkesConfirmAssistance::class, 'personal_data_id');
    }
}
