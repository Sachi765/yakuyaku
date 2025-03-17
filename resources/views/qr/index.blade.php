
<x-app-layout>
    <div class="flex justify-center items-center flex-col h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <img src="data:image/png;base64, {!! base64_encode($qrCode) !!} " alt="QR Code" class="w-60 h-60">
                </div>
            </div>
        </div>
        <div class="p-6 text-gray-900">
                QRコードを読み込むと予約詳細ページに遷移します。
        </div>
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20 h-20 mb-4">
    </div>
    
</x-app-layout>
