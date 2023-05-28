<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialist_id',
        'name',
        'photo',
        'location',
        'price',
        'review',
        'star',
        'total_review',
    ];

    // TODO: add relations
    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
