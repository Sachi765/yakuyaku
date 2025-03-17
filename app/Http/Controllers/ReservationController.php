<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Events\StatusUpdated;
use App\Constants\CommonConstants;

class ReservationController extends Controller
{

    public function index($reservation_id)
    {
        $today = now()->format('Y-m-d');
        $reservation = Reservation::findOrFail($reservation_id);
        
        // 予約が無効の処理
        if (empty($reservation)) {
            return redirect()->route('errors.404');
        }elseif($reservation->to_time < $today || $reservation->status == CommonConstants::STATUS_NONE){
            return redirect()->route('errors.404');
        }
        
        $user = User::findOrFail($reservation->user_id);
        
        return view('reservation.index', compact('reservation', 'user'));
    }

}
