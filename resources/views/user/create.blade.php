<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('患者登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-between">
            <h3 class="text-2xl font-medium text-gray-900">
                患者登録
            </h3>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <div class="flex items-center">
                                <x-input-label for="name" :value="__('名前')" />
                                <span class="text-red-500">*</span>
                            </div>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <button class="bg-green-500 min-w-40 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
