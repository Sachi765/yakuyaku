<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <div class="my-4">
                        <h3 class="text-lg font-bold mb-2">予約番号</h3>
                        <p class="text-4xl font-bold">{{ $reservation->reservation_number }}</p>
                    </div>
                    <div class="my-4">
                        @if ($reservation->status == $STATUS_RECEIVED)
                            <div  id="reservation-status" class="bg-blue-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full">
                                受付完了
                            </div>
                        @elseif ($reservation->status == $STATUS_IN_PROGRESS)
                            <div id="reservation-status" class="bg-pink-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full">
                                処方中
                            </div>
                        @elseif ($reservation->status == $STATUS_COMPLETED)
                            <div id="reservation-status" class="bg-red-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full">
                                処方完了
                            </div>
                        @else
                        <script>
                            window.location.href = '/404';
                        </script>
                        @endif
                    </div>
                    <div class="my-4">
                        <h3 class="text-lg font-bold mb-2">完了予定時刻</h3>
                        @php
                            $to_time = \Carbon\Carbon::parse($reservation->to_time);
                        @endphp
                        @if($to_time->isBefore(\Carbon\Carbon::now()))
                            <p class="text-2xl text-red-500">{{ $to_time->format('H時i分') }}</p>
                        @else
                            <p class="text-2xl">{{ $to_time->format('H時i分') }}</p>
                        @endif
                    </div>
                </div>
            </div>
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20 h-20 mb-4 mx-auto mt-4">
        </div>
    </div>
</x-app-layout>

<script>

//Pusher.logToConsole = true;

var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
  cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
});

var channel = pusher.subscribe('status-updated');
channel.bind('status.updated', function(data) {
    console.log('受信したデータの型:', typeof data);
    console.log('受信したデータ:', data);
    
    if (data === undefined) {
        console.log('データが未定義です');
        return;
    }

    // データの中身を詳しく確認
    Object.keys(data).forEach(key => {
        console.log(`${key}:`, data[key]);
    });

    //alert(JSON.stringify(data));
    const reservation = data.reservation;
    const status = reservation.status.toString();
    const reservationStatus = document.getElementById('reservation-status');
    switch (status) {
    case '{{ $STATUS_RECEIVED }}':
        reservationStatus.textContent = '受付完了';
        reservationStatus.className = 'bg-blue-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full';
        break;
    case '{{ $STATUS_IN_PROGRESS }}':
        reservationStatus.textContent = '処方中';
        reservationStatus.className = 'bg-pink-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full';
        break;
    case '{{ $STATUS_COMPLETED }}':
        reservationStatus.textContent = '処方完了';
        reservationStatus.className = 'bg-red-500 max-w-40 mx-auto text-white font-bold py-2 px-4 rounded-full';
        break;
    default:
        location.href = '/404';
  }
});

</script>