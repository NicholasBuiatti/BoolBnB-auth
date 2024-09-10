<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;


class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'duration',
        'active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class)
            ->withPivot('starting_date', 'ending_date')
            ->withTimestamps();
    }
}
