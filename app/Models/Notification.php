<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Notification extends Model
{
    protected $fillable = [
        'reservation_id',
        'type',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'type' => 'integer',
    ];

    const TYPE_RECEIVED = 0;
    const TYPE_IN_PROGRESS = 1;
    const TYPE_COMPLETED = 9;

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
