<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl glow-blue text-gray-800 leading-tight">
            Confirm Deletion
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        <p class="text-lg font-semibold glow-red">
            本当に削除しますか？
        </p>

        {{-- 削除対象の投稿を表示する --}}
        <div class="mt-4 p-4 bg-transparent border-2 border-neon-blue glow-deep-blue">
            <p><strong>投稿者:</strong> {{ $post->user->name }}</p>
            <p class="mt-2"><strong>投稿内容:</strong> {{ $post->content }}</p>
            <p class="mt-2"><strong>投稿日:</strong> {{ $post->created_at }}</p>
        </div>

        <div class="mt-6 flex gap-4">
            <form method="POST" action="{{ route('post.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <button class="delete-button">
                    <i class="fas fa-trash-alt"></i> 削除する
                </button>
            </form>

            {{-- キャンセルボタン（一覧ページに戻る） --}}
            <a href="{{ route('post.index') }}" class="inline-block">
                <button class="cancel-button">
                    <i class="fas fa-ban"></i> キャンセル
                </button>
            </a>
        </div>
    </div>
</x-app-layout>
