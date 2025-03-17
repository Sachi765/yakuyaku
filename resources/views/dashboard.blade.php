<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full sm:w-1/3 sm:mr-2 mb-4 sm:mb-0 aspect-square">
                <a href="{{ route('admin.index') }}" class="flex flex-col items-center justify-center w-full h-full font-bold text-xl text-gray-600 hover:underline">
                    <hgroup>
                        <div class="p-4 text-gray-900 text-center">
                        <svg id="Layer_1" class="m-auto" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="150" height="150" color="#4e4e4e"><defs><style>.cls-6374f8d9b67f094e4896c670-1{fill:none;stroke:currentColor;stroke-miterlimit:10;}</style></defs><circle class="cls-6374f8d9b67f094e4896c670-1" cx="12" cy="7.25" r="5.73"></circle><path class="cls-6374f8d9b67f094e4896c670-1" d="M1.5,23.48l.37-2.05A10.3,10.3,0,0,1,12,13h0a10.3,10.3,0,0,1,10.13,8.45l.37,2.05"></path></svg>
                        </div>
                        <h2 class="p-6 text-gray-900 text-center">
                            管理者一覧
                        </h2>
                    </hgroup>
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full sm:w-1/3 sm:mr-2 mb-4 sm:mb-0 aspect-square">
                <a href="{{ route('user.index') }}" class="flex flex-col items-center justify-center w-full h-full font-bold text-xl text-gray-600 hover:underline">
                    <hgroup>
                        <div class="p-4 text-gray-900 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" width="150" height="150" color="#4e4e4e"><defs><style>.cls-637b8170f95e86b59c57a033-1{fill:none;stroke:currentColor;stroke-miterlimit:10;}</style></defs><g id="drug"><rect class="cls-637b8170f95e86b59c57a033-1" x="4.34" y="0.3" width="6.74" height="14.83" rx="3.37" transform="translate(7.71 -3.19) rotate(45)"></rect><circle class="cls-637b8170f95e86b59c57a033-1" cx="16.76" cy="16.76" r="5.72"></circle><line class="cls-637b8170f95e86b59c57a033-1" x1="20.77" y1="20.77" x2="12.95" y2="12.95"></line><line class="cls-637b8170f95e86b59c57a033-1" x1="10.09" y1="10.09" x2="5.33" y2="5.33"></line></g></svg>
                        <h2 class="py-6 text-gray-900 text-center">
                            患者一覧
                        </h2>
                    </hgroup>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
