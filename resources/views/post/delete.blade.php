<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            削除確認
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <p class="text-lg font-semibold text-red-600">
            本当に削除しますか？
        </p>

        {{-- 削除対象の投稿を表示する --}}
        <div class="mt-4 p-4 bg-gray-100 rounded-md">
            <p><strong>投稿者:</strong> {{ $post->user->name }}</p>
            <p class="mt-2"><strong>投稿内容:</strong> {{ $post->content }}</p>
            <p class="mt-2 text-sm text-gray-500">投稿日: {{ $post->created_at }}</p>
        </div>

        <div class="mt-6 flex gap-4">
            {{-- 削除ボタン（実際に削除を実行する） --}}
            <form method="POST" action="{{ route('post.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <x-primary-button class="bg-red-700">
                    削除する
                </x-primary-button>
            </form>

            {{-- キャンセルボタン（一覧ページに戻る） --}}
            <a href="{{ route('post.index') }}" class="inline-block">
                <x-primary-button class="bg-gray-500">
                    キャンセル
                </x-primary-button>
            </a>
        </div>
    </div>
</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            削除確認
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <p class="text-lg font-semibold text-red-600">
            本当に削除しますか？
        </p>
        <p class="mt-4">
            投稿者: {{ $post->user->name }}<br>
            投稿内容: {{ $post->content }}
        </p>

        <div class="mt-6 flex gap-4">
            <form method="POST" action="{{ route('post.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <x-primary-button class="bg-red-700">
                    削除する
                </x-primary-button>
            </form>
            <a href="{{ route('post.index') }}" class="inline-block">
                <x-primary-button class="bg-gray-500">
                    キャンセル
                </x-primary-button>
            </a>
        </div>
    </div>
</x-app-layout> --}}
