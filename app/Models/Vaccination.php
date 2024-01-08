<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'health_status',
        'respiratory_rate', 
        'heart_rate',
        'contactante',
        'dewormed_status', 
        'date_dewormed',
        'vaccinated_status',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
    
}
