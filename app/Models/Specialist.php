<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'fee',
    ];

    // TODO: add relations
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
