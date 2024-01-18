<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'name', 'owner_name', 'address', 'neighborhood', 'contact', 'species',
        'birth', 'race', 'exercise_routine', 'reproductive_status', 'size', 'fur_length', 'origin','deleted', 'user_id',
    ];

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
