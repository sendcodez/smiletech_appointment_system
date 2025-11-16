<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalConditions extends Model
{
    use HasFactory,softDeletes;

    protected $table = 'medical_conditions';
    protected $fillable = [
        'user_id',
        'steriod',
        'rheumatic',
        'epilepsy',
        'asthma',
        'diabetes',
        'heart_disorder',
        'bone_disease',
        'radiation',
        'kidney_disease',
        'excessive_bleeding',
        'stroke',
        'cancer',
        'tuberculosis',
        'thyroid_disease',
        'nervous',
        'high_blood',
        'prosthetic_implant',
        'cardiac_pacemaker',
        'stomach_condition',
        'hepatitis',
        'blood_borne',
        'bronchitis',
        'anaemia',
        'other_condition',
    ];
}
