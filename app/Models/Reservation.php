<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reservation extends Model
{
    protected $fillable = [
        'reservation_number',
        'user_id',
        'qr_code',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    const STATUS_RECEIVED = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED = 9;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
