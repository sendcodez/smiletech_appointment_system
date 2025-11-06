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

// App/Models/Appointment.php

public function scopePending($query)
{
    return $query->where('status', 1);
}

public function scopeApproved($query)
{
    return $query->where('status', 2);
}

public function scopeCompleted($query)
{
    return $query->where('status', 3);
}

public function scopeCancelled($query)
{
    return $query->where('status', 4);
}


}
