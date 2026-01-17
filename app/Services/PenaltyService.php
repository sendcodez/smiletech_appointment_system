<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPenalty;
use App\Models\Appointment;
use Carbon\Carbon;

class PenaltyService
{
    // Penalty thresholds
    const WARNING_THRESHOLD = 1;      // First warning
    const TEMPORARY_BLOCK_THRESHOLD = 2;  // 7 days block
    const EXTENDED_BLOCK_THRESHOLD = 3;   // 30 days block
    const PERMANENT_BLOCK_THRESHOLD = 5;  // Permanent block

    /**
     * Mark an appointment as no-show and apply penalties
     */
    public function markAsNoShow(Appointment $appointment)
    {
        // Mark appointment as no-show
        $appointment->update([
            'is_no_show' => true,
            'marked_no_show_at' => now(),
            'status' => 4 // Cancelled status
        ]);

        $user = $appointment->user;
        $penalty = $user->getOrCreatePenalty();

        // Increment no-show count
        $penalty->increment('no_show_count');
        $penalty->refresh();

        // Apply penalty based on count
        $this->applyPenalty($penalty);

        return $penalty;
    }

    /**
     * Apply penalty based on no-show count
     */
    protected function applyPenalty(UserPenalty $penalty)
    {
        $count = $penalty->no_show_count;

        switch ($count) {
            case self::WARNING_THRESHOLD:
                $penalty->update([
                    'penalty_reason' => 'First warning: Missing appointments without notice is not allowed.'
                ]);
                // Send warning notification (optional)
                break;

            case self::TEMPORARY_BLOCK_THRESHOLD:
                $penalty->update([
                    'is_blocked' => true,
                    'blocked_until' => now()->addDays(7),
                    'penalty_reason' => 'Account temporarily blocked for 7 days due to ' . $count . ' no-shows.'
                ]);
                // Cancel all pending/approved appointments
                $this->cancelUserAppointments($penalty->user_id);
                break;

            case self::EXTENDED_BLOCK_THRESHOLD:
                $penalty->update([
                    'is_blocked' => true,
                    'blocked_until' => now()->addDays(30),
                    'penalty_reason' => 'Account blocked for 30 days due to ' . $count . ' no-shows.'
                ]);
                $this->cancelUserAppointments($penalty->user_id);
                break;

            case self::PERMANENT_BLOCK_THRESHOLD:
                $penalty->update([
                    'is_blocked' => true,
                    'blocked_until' => null, // Permanent
                    'penalty_reason' => 'Account permanently blocked due to ' . $count . ' no-shows. Contact admin for appeal.'
                ]);
                $this->cancelUserAppointments($penalty->user_id);
                break;

            default:
                // For counts beyond permanent threshold, keep the permanent block
                if ($count > self::PERMANENT_BLOCK_THRESHOLD) {
                    $penalty->update([
                        'penalty_reason' => 'Account permanently blocked due to ' . $count . ' no-shows. Contact admin for appeal.'
                    ]);
                }
                break;
        }
    }

    /**
     * Cancel all pending and approved appointments for a user
     */
    protected function cancelUserAppointments($userId)
    {
        Appointment::where('user_id', $userId)
            ->whereIn('status', [1, 2]) // Pending or Approved
            ->update([
                'status' => 4,
                'cancellation_reason' => 'Auto-cancelled due to account penalty'
            ]);
    }

    /**
     * Check if user is eligible to book appointments
     */
    public function checkUserEligibility(User $user)
    {
        $penalty = $user->penalty;

        if (!$penalty) {
            return ['eligible' => true];
        }

        if ($penalty->isCurrentlyBlocked()) {
            $message = $penalty->blocked_until 
                ? 'Your account is blocked until ' . $penalty->blocked_until->format('M d, Y')
                : 'Your account is permanently blocked';
            
            return [
                'eligible' => false,
                'message' => $message . '. Reason: ' . $penalty->penalty_reason
            ];
        }

        return ['eligible' => true];
    }

    /**
     * Reset a user's penalty (Admin only)
     */
    public function resetPenalty($userId)
    {
        $penalty = UserPenalty::where('user_id', $userId)->first();
        
        if ($penalty) {
            $penalty->update([
                'no_show_count' => 0,
                'is_blocked' => false,
                'blocked_until' => null,
                'penalty_reason' => null
            ]);
            
            return true;
        }
        
        return false;
    }

    /**
     * Get penalty statistics for a user
     */
    public function getUserPenaltyStats($userId)
    {
        $penalty = UserPenalty::where('user_id', $userId)->first();
        
        if (!$penalty) {
            return [
                'no_show_count' => 0,
                'is_blocked' => false,
                'status' => 'Good standing'
            ];
        }

        $status = 'Good standing';
        
        if ($penalty->is_blocked) {
            $status = $penalty->blocked_until ? 'Temporarily blocked' : 'Permanently blocked';
        } elseif ($penalty->no_show_count > 0) {
            $status = 'Warning issued';
        }

        return [
            'no_show_count' => $penalty->no_show_count,
            'is_blocked' => $penalty->is_blocked,
            'blocked_until' => $penalty->blocked_until,
            'status' => $status,
            'penalty_reason' => $penalty->penalty_reason
        ];
    }
}