<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccompanimentPersonalData extends Model
{
    use HasFactory;

    /**
     * Table Name
     *
     * @var string
     */
    protected $table = 'accompaniment_personal_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cooperative_id',
        'problem',
        'reason',
    ];

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }

    public function confirm_assistance()
    {
        return $this->hasOne(AccompanimentConfirmAssistance::class, 'personal_data_id');
    }
}
