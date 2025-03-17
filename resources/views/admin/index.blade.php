<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('管理者一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
            <h3 class="text-2xl font-medium text-gray-900">
                管理者一覧
            </h3>
            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                <a href="{{ route('admin.create') }}">管理者登録</a>
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
                <table class="min-w-full divide-y divide-greengray-200 hidden md:table">
                        <thead>
                            <tr>
                                <th scope="col" class="w-1/4 px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col" class="w-1/4 px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('名前') }}
                                </th>
                                <th scope="col" class="w-1/4 px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('ログインID') }}
                                </th>
                                <th scope="col" class="w-1/4 px-6 py-3 bg-gray-300 text-center text-s font-medium text-gray-500 uppercase tracking-wider">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                    {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $user->login_id }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900 text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            <a href="{{ route('admin.edit', ['id' => $user->id]) }}" class="min-w-20 bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                                                編集
                                            </a>
                                            <button type="button" class="min-w-20 bg-red-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700" onclick="confirmDelete({{ $user->id }})">
                                                削除
                                            </button>
                                        </div>
                                        <div id="deleteModal-{{ $user->id }}" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                                </div>
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                                    確認
                                                                </h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">
                                                                        本当にこの管理者を削除しますか？
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <form action="{{ route('admin.delete', ['id' => $user->id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                削除
                                                            </button>
                                                        </form>
                                                        <button type="button" onclick="closeModal({{ $user->id }})" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            キャンセル
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                     <!-- スマホ版のカード表示 (md未満で表示) -->
                    <div class="md:hidden space-y-4">
                        @foreach ($users as $user)
                            <div class="bg-white shadow rounded-lg p-4 space-y-3">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="text-gray-500">ID</div>
                                    <div>{{ $user->id }}</div>
                                    
                                    <div class="text-gray-500">名前</div>
                                    <div>{{ $user->name }}</div>
                                    
                                    <div class="text-gray-500">ログインID</div>
                                    <div>{{ $user->login_id }}</div>
                                </div>

                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('admin.edit', ['id' => $user->id]) }}" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700 text-center">
                                        編集
                                    </a>
                                    <button type="button" class="w-full bg-red-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-700" onclick="confirmDelete({{ $user->id }})">
                                        削除
                                    </button>
                                </div>

                                <!-- 削除確認モーダル -->
                                <div id="deleteModal-{{ $user->id }}" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                        </div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                            確認
                                                        </h3>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-500">
                                                                本当にこの管理者を削除しますか？
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <form action="{{ route('admin.delete', ['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        削除
                                                    </button>
                                                </form>
                                                <button type="button" onclick="closeModal({{ $user->id }})" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                    キャンセル
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function confirmDelete(userId) {
        document.getElementById('deleteModal-' + userId).classList.remove('hidden');
    }

    function closeModal(userId) {
        document.getElementById('deleteModal-' + userId).classList.add('hidden');
    }
</script>