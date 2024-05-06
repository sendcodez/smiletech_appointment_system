<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'business_name',
        'store_close',
        'store_hour_start',
        'store_hour_end',
        'addres',
        'email',
        'contact_number',
        'about',
        'tagline',
        'customer_morning',
        'customer_afternoon',
    ];

    protected $casts = [
        'store_close' => 'array',
    ];

}
