<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'text',
        'apartment_id',
    ];
    protected $dates = ['deleted_at'];
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
