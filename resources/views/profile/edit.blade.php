<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- プロフィール情報の表示 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-4">
                        <img src="{{ auth()->user()->icon ? Storage::url(auth()->user()->icon) : asset('images/kanu.png') }}"
                            class="w-20 h-20 rounded-full object-contain">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ auth()->user()->name }}
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ auth()->user()->bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- プロフィール情報の更新 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <!-- アイコン -->
                        <div class="w-full flex flex-col">
                            <label for="icon" class="font-semibold mt-4">アイコン</label>
                            <input type="file" name="icon" id="icon"
                                class="w-auto py-2 border border-gray-300 rounded-md">
                        </div>
                        <!-- メッセージ -->
                        <div class="w-full flex flex-col">
                            <label for="bio" class="font-semibold mt-4">メッセージ</label>
                            <textarea name="bio" id="bio" rows="3" class="w-auto py-2 border border-gray-300 rounded-md">{{ old('bio', auth()->user()->bio) }}</textarea>
                        </div>
                        <x-primary-button class="mt-4">
                            保存
                        </x-primary-button>
                    </form>
                    <p>アクションURL: {{ route('profile.update') }}</p>
                </div>
            </div>
            <!-- パスワード変更 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <!-- ユーザー削除 -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            {{-- 
            <!-- Alpine.js -->
            <div x-data="{ isBlue: false }" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <button @click="isBlue = !isBlue" class="p-2 bg-blue-500 text-white rounded">
                        Toggle Background Color
                    </button>

                    <div :class="{ 'bg-blue-500': isBlue, 'bg-gray-200': !isBlue }" class="mt-4 p-8">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

</x-app-layout>
