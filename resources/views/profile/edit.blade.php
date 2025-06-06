<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl glow-blue leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            <!-- ユーザー情報表示 -->
            <div class="p-4 sm:p-10 bg-opacity-80 rounded-xl shadow-xl glow-green text-white glow-green-text-shadow">
                <div class="max-w-xl">
                    <div class="flex items-center space-x-6">
                        <div class="hexagon-shadow">
                            <div class="hexagon-inner ">
                                <img src="{{ auth()->user()->icon ? Storage::url(auth()->user()->icon) : asset('images/kanu.png') }}"
                                    alt="User Icon" />
                            </div>
                        </div>
                        <div class="space-y-1">
                            <h2 class="text-lg font-semibold glow-text-pink">
                                {{ auth()->user()->name }}
                            </h2>
                            <p class="">{{ auth()->user()->bio }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- アイコン・メッセージ更新フォーム -->
            <div class="p-4 sm:p-10 bg-opacity-80 rounded-xl shadow-xl glow-green">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="w-full flex flex-col">
                            <label for="icon"
                                class="font-semibold mt-4 text-white glow-green-text-shadow mb-3">Icon</label>
                            <div class="flex items-center space-x-4">
                                <label for="icon" class="select-file-button text-center w-fit">
                                    SELECT FILE
                                </label>
                                <p id="file-name" class="mt-2 text-sm text-white glow-green-text-shadow"></p>
                            </div>
                            <input type="file" name="icon" id="icon" class="hidden" />
                        </div>

                        <div class="w-full flex flex-col">
                            <label for="bio"
                                class="font-semibold mt-4 text-white glow-green-text-shadow mb-3">Message</label>
                            <textarea name="bio" id="bio" rows="3"
                                class="w-full py-2 px-3 rounded-md glow-blue-green bg-transparent focus:ring-green-700 focus:ring-2 focus:ring-offset-0 focus:border-transparent text-white glow-green-text-shadow">{{ old('bio', auth()->user()->bio) }}</textarea>
                        </div>

                        <x-primary-button class="mt-6 glow-blue-green profile-button">
                            Save
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <!-- パスワード変更 -->
            <div class="p-4 sm:p-10 bg-opacity-80 rounded-xl shadow-xl glow-green">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- アカウント削除 -->
            <div class="p-4 sm:p-8 bg-opacity-80 rounded-xl shadow-xl glow-green">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('icon');
            const fileNameDisplay = document.getElementById('file-name');

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = `Selected: ${fileInput.files[0].name}`;
                } else {
                    fileNameDisplay.textContent = '';
                }
            });
        });
    </script>
</x-app-layout>
