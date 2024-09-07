<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    protected $dates=['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);

    } 
}
