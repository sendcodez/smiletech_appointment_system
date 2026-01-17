<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPenalty extends Model
{
    protected $fillable = [
        'user_id',
        'no_show_count',
        'is_blocked',
        'blocked_until',
        'penalty_reason'
    ];

    protected $casts = [
        'is_blocked' => 'boolean',
        'blocked_until' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isCurrentlyBlocked()
    {
        if (!$this->is_blocked) {
            return false;
        }

        if ($this->blocked_until && now()->greaterThan($this->blocked_until)) {
            // Auto-unblock if penalty period has expired
            $this->update([
                'is_blocked' => false,
                'blocked_until' => null,
                'no_show_count' => 0
            ]);
            return false;
        }

        return true;
    }
}
