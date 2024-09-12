<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable=[
        'apartment_id',
        'ip_address',
        'date_visit',
    ];

    protected $hidden=[
        'created_at',
        'updated_at',
    ];


    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
