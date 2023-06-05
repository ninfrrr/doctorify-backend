<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'reviewer',
        'text',
        'verdict',
        'score',
        'magnitude',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
