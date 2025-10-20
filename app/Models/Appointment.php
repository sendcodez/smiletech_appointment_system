<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_id',
        'date',
        'day',
        'status',
        'time',
        'remarks',
        'reference_number',

    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // In App\Models\Appointment.php

public function services()
{
    return $this->belongsToMany(Service::class, 'appointment_service', 'appointment_id', 'service_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
