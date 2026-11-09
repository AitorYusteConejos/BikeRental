<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $fillable = [
        'serial_number',
        'model',
        'price_per_hour',
        'status',
    ];
}
