<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

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
}
