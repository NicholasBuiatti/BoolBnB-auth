<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;

class Service extends Model
{
    //tolto timestamps così lancia il seeder;
    
    use HasFactory;
    protected $fillable=[
        'name',
    ];
    protected $hidden=[
        'created_at',
        'updated_at'];

        public function apartments(){
            return $this->belongsToMany(Apartment::class);
        }

};
