<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Reservation;

class QrController extends Controller
{

    public function index($id)
    {
        $reservation = Reservation::findOrFail($id);
        $qrCode = QrCode::format('png')->size(240)->generate(route('reservation.index', $reservation->id));
        return view('qr.index', compact('qrCode'));
    }
}
