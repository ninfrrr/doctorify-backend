<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

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
