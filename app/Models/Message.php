<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'image',
        'latitude',
        'longitude',
    ];

    // Relationship with User (sender)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relationship with User (receiver)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Calculate the distance between two points
    public function calculateDistance($user)
    {
        // Haversine formula for distance between coordinates
        $earthRadius = 6371; // Earth radius in kilometers

        $lat1 = deg2rad($this->latitude);
        $lon1 = deg2rad($this->longitude);
        $lat2 = deg2rad($user->latitude);
        $lon2 = deg2rad($user->longitude);

        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos($lat1) * cos($lat2) *
            sin($dlon / 2) * sin($dlon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in kilometers

        return $distance;
    }

    // Get messages sent by the current user
    public static function getUserChats($userId)
    {
        // Fetch messages where the current user is either sender or receiver
        return self::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get();
    }
}
