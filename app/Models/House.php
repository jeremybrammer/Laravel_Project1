<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_street',
        'address_city',
        'address_state',
        'address_zip',
        'description',
        'price',
        'sold'
    ];
}
