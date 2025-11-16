<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalHistories extends Model
{
    use HasFactory,softDeletes;
    
    protected $table = 'medical_histories';
    protected $fillable = [
        'user_id',
        'antibiotic',
        'smoke',
        'treated',
        'hospitalized',
        'abnormal',
        'pregnant',
        'prescription',
        'medications',
        'allergies',
        'known_allergies',

    ];
}
