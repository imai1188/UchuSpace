<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl glow-blue leading-tight">
            New Post Form
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 relative">
        @if (session('message'))
            <div class="flash-message text-lg font-bold absolute mb-4 left-[20%] z-10">
                {{ session('message') }}
            </div>
        @endif

        <form method="post" action="{{ route('post.store') }}">
            @csrf

            <div class="w-full flex flex-col mb-6"> {{-- mb-6 を追加して下の要素との間隔を確保 --}}
                <label for="body" class="font-semibold text-2xl glow-blue leading-tight mb-2">本文</label>
                {{-- ラベルのスタイルを統一 --}}
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                <textarea name="content"
                    class="
                        font-jp w-auto py-2
                        bg-transparent border-2 border-neon-blue rounded-md
                        text-cyan-300 placeholder-cyan-600 focus:outline-none resize-none glow-deep-blue"
                    id="body" cols="30" rows="5" placeholder="ここに投稿内容を入力してください">{{ old('content') }}</textarea>
            </div>

            <div class="mb-6"> {{-- mb-6 を追加して下の要素との間隔を確保 --}}
                <label for="spotify_track_id"
                    class="font-semibold text-2xl glow-blue leading-tight mb-2 block">SpotifyトラックID（任意）</label>
                {{-- ラベルのスタイルを統一 --}}
                <x-input-error :messages="$errors->get('spotify_track_id')" class="mt-2" /> {{-- SpotifyトラックIDのエラー表示を追加 --}}
                <input type="text" name="spotify_track_id" id="spotify_track_id"
                    class="
                        w-96 py-2
                        bg-transparent border-2 border-neon-blue rounded-md
                        text-cyan-300 placeholder-cyan-600 focus:outline-none glow-deep-blue
                    "
                    value="{{ old('spotify_track_id') }}" placeholder="例: 3Swc58q85zNn907eY070gD">
            </div>

            {{-- ボタンエリア（投稿ボタン） --}}
            <div class="mt-6 flex gap-4">
                <button class="post-button" type="submit"> {{-- type="submit" を追加 --}}
                    <i class="fas fa-paper-plane"></i> Post
                </button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = document.querySelector('.flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.add('animate-ufo-float-away');
                    setTimeout(() => flashMessage.remove(), 2000);
                }, 2500);
            }
        });
    </script>
</x-app-layout>
