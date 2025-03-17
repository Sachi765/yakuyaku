<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('患者一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
            <h3 class="text-2xl font-medium text-gray-900">
                患者一覧
            </h3>
            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                <a href="{{ route('user.create') }}">患者登録</a>
            </button>
        </div>
    </div>
    <div class="py-4">
        @if(session('message'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-200 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-4 text-black">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-200 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-4 text-black">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-greengray-200 hidden md:table">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('予約番号') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('名前') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('受付時間') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('完了予定時刻') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('ステータス') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    @php
                                        $latestReservation = $user->reservations->first();
                                        if($latestReservation){
                                            $status = $latestReservation->status;
                                            $reservation_id = $latestReservation->id;
                                            $from_time = \Carbon\Carbon::parse($latestReservation->from_time);
                                            $to_time = \Carbon\Carbon::parse($latestReservation->to_time);
                                        }else{
                                            $status = null;
                                            $reservation_id = null;
                                            $from_time = null;
                                            $to_time = null;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $user->reservation_number }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($from_time && $status > $STATUS_NONE)
                                                {{ $from_time->format('H:i') }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($to_time && $status > $STATUS_NONE)
                                                @if($to_time->isBefore(\Carbon\Carbon::now()))
                                                    <span class="text-red-500">{{ $to_time->format('H:i') }}</span>
                                                @else
                                                    {{ $to_time->format('H:i') }}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            <form action="{{ route('user.statusUpdate') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
                                                @if ($status == $STATUS_RECEIVED)
                                                    <button type="submit" class="min-w-40 bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-blue-700">
                                                        受付完了
                                                    </button>
                                                @elseif ($status == $STATUS_IN_PROGRESS)
                                                    <button type="submit" class="min-w-40 bg-pink-500 text-white font-bold py-2 px-4 rounded-full hover:bg-pink-700">
                                                        処方中
                                                    </button>
                                                @elseif ($status == $STATUS_COMPLETED)
                                                    <button type="submit" class="min-w-40 bg-red-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700">
                                                        処方完了
                                                    </button>
                                                @else
                                                    <button type="submit" class="min-w-40 bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                                                        受付なし
                                                    </button>    
                                                @endif
                                            </form>
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                            @if($from_time && $status > $STATUS_NONE)
                                                <a class="min-w-40 bg-gray-500 text-white font-bold py-2 px-4 rounded-full hover:bg-gray-700" href="{{ route('qrcode.index', ['id' => $reservation_id]) }}" target="_blank">
                                                    QRコード
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- スマホ版のカード表示 (md未満で表示) -->
                        <div class="md:hidden space-y-4">
                                @foreach ($users as $user)
                                    @php
                                        $latestReservation = $user->reservations->first();
                                        if($latestReservation){
                                            $status = $latestReservation->status;
                                            $reservation_id = $latestReservation->id;
                                            $from_time = \Carbon\Carbon::parse($latestReservation->from_time);
                                            $to_time = \Carbon\Carbon::parse($latestReservation->to_time);
                                        }else{
                                            $status = null;
                                            $reservation_id = null;
                                            $from_time = null;
                                            $to_time = null;
                                        }
                                    @endphp
                                    <div class="bg-white shadow rounded-lg p-4 space-y-3">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="text-gray-500">予約番号</div>
                                            <div>{{ $user->reservation_number }}</div>
                                            
                                            <div class="text-gray-500">名前</div>
                                            <div>{{ $user->name }}</div>
                                            
                                            <div class="text-gray-500">受付時間</div>
                                            <div>
                                                @if($from_time && $status > $STATUS_NONE)
                                                    {{ $from_time->format('H:i') }}
                                                @endif
                                            </div>
                                            
                                            <div class="text-gray-500">完了予定時刻</div>
                                            <div>
                                                @if($to_time && $status > $STATUS_NONE)
                                                    @if($to_time->isBefore(\Carbon\Carbon::now()))
                                                        <span class="text-red-500">{{ $to_time->format('H:i') }}</span>
                                                    @else
                                                        {{ $to_time->format('H:i') }}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-col space-y-2">
                                            <form action="{{ route('user.statusUpdate') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
                                                @if ($status == $STATUS_RECEIVED)
                                                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-full hover:bg-blue-700">
                                                        受付完了
                                                    </button>
                                                @elseif ($status == $STATUS_IN_PROGRESS)
                                                    <button type="submit" class="w-full bg-pink-500 text-white font-bold py-2 px-4 rounded-full hover:bg-pink-700">
                                                        処方中
                                                    </button>
                                                @elseif ($status == $STATUS_COMPLETED)
                                                    <button type="submit" class="w-full bg-red-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700">
                                                        処方完了
                                                    </button>
                                                @else
                                                    <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                                                        受付なし
                                                    </button>    
                                                @endif
                                            </form>

                                            @if($from_time && $status > $STATUS_NONE)
                                                <a class="w-full bg-gray-500 text-white font-bold py-2 px-4 rounded-full hover:bg-gray-700 text-center" href="{{ route('qrcode.index', ['id' => $reservation_id]) }}" target="_blank">
                                                    QRコード
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>