<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dentist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'user_id',
        'firstname',
        'middlename',
        'lastname',
        'about',
        'image',
        'status',
        'contact_number',
        'address',
        'email',
        'password',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
