<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            フォーム
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        {{-- @if (session('message'))
            <div class="text-red-600 font-bold">
                {{ session('message') }}
            </div>
        @endif --}}
        <x-message :message="session('message')" />
        <form method="post" action="{{ route('post.store') }}">
            @csrf
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                <textarea name="content" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30"
                    rows="5">{{ old('content') }}</textarea>
            </div>
            {{-- ボタンエリア（投稿ボタン） --}}
            <div class="mt-6 flex gap-4">
                <x-primary-button class="bg-blue-600">
                    投稿する
                </x-primary-button>

                {{-- 
                <a href="{{ route('post.index') }}" class="inline-block">
                    <x-primary-button class="bg-gray-500">
                        キャンセル
                    </x-primary-button> --}}
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
