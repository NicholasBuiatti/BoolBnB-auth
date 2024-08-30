<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'dimension_mq',
        'image',
        'latitude',
        'longitude',
        'address_full',
        'is_visible',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
