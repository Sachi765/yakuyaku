<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Notification;
use App\Constants\CommonConstants;
use DateTime;
use Illuminate\Support\Facades\DB;
use App\Events\StatusUpdated;

class UserController extends Controller
{
    // ユーザー一覧画面表示
    function index(){
        $users = User::with(['reservations' => function($query) {
            $query->whereDate('created_at', now()->format('Y-m-d'))
                  ->latest()->take(1); 
        }])
        ->where('role', CommonConstants::ROLE_USER)
        ->get()->sortBy(function($user) {
            return $user->reservations->first()->status ?? '';
        });
    
        return view('user.index',['users'=>$users]);
    }

    // ユーザー登録画面表示
    function create(){
        return view('user.create');
    }

    // ユーザーを作成するメソッド
    function store(Request $request){

        $today = now();

        User::create([
            'name' => $request->name,
            'role' => CommonConstants::ROLE_USER
        ]);

        Reservation::create([
            'reservation_number' => self::generateReservationNumber(),
            'user_id' => $user->id,
            'from_time' => $today,
            'to_time' => self::calculateWaitingTime(),
            'status' => CommonConstants::STATUS_RECEIVED
        ]);

        return redirect()->route('user.index');
    }

    // 予約のステータスを更新するメソッド
    public function statusUpdate(Request $request)
    {
        $today = now();
        $user_id = $request->user_id;

        if($request->reservation_id){
            $reservation_id = $request->reservation_id;
            $reservation = Reservation::findOrFail($reservation_id);
        }

        if(!empty($reservation) && $reservation->status != CommonConstants::STATUS_COMPLETED){
            switch ($reservation->status) {
                case CommonConstants::STATUS_NONE:
                    $reservation->status = CommonConstants::STATUS_RECEIVED;
                    $reservation->from_time = $today;
                    $reservation->to_time = self::calculateWaitingTime();
                    break;
                case CommonConstants::STATUS_RECEIVED:
                    $reservation->status = CommonConstants::STATUS_IN_PROGRESS;
                    break;
                case CommonConstants::STATUS_IN_PROGRESS:
                    $reservation->status = CommonConstants::STATUS_COMPLETED;
                    break;
                default:
                    return redirect()->route('user.index')->with('error', '無効なステータスです');
            }
            $reservation->save();
        }elseif($reservation->status == CommonConstants::STATUS_COMPLETED){
            Reservation::create([
                'reservation_number' => self::generateReservationNumber(),
                'user_id' => $user_id,
                'from_time' => $today,
                'to_time' => self::calculateWaitingTime(),
                'status' => CommonConstants::STATUS_NONE
            ]);
        }else{
            Reservation::create([
                'reservation_number' => self::generateReservationNumber(),
                'user_id' => $user_id,
                'from_time' => $today,
                'to_time' => self::calculateWaitingTime(),
                'status' => CommonConstants::STATUS_RECEIVED
            ]);
        }
        
        event(new StatusUpdated($reservation));
        
        return redirect()->route('user.index')->with('message', 'ステータスが更新されました');

    }

    // 現在時刻から未来の時間を計算するメソッド
    public static function calculateWaitingTime()
    {
        $currentDateTime = new \DateTime();
        $currentDateTime->modify('+' . CommonConstants::WAITING_TIME_MINUTES . ' minutes');
        return $currentDateTime;
    }

    // 予約番号を生成するメソッド
    public static function generateReservationNumber()
    {
        $today = now()->format('Y-m-d'); 
        
        $lastReservation = Reservation::whereDate('created_at', $today)->max('reservation_number'); 

        $reservationNumber = ($lastReservation !== null) ? $lastReservation + 1 : CommonConstants::RESERVATION_NUMBER_MIN;
        return $reservationNumber;
    }

}
