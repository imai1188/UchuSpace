<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl glow-blue leading-tight">
            Posts
        </h2>
    </x-slot>
    <div id="three-index" class="relative w-full h-[400px]"></div>
    <div class="mx-auto px-6" x-data="{ show: {{ session('first_time') ? 'false' : 'true' }} }" x-init="setTimeout(() => show = true, 100)">
        @if (session('message'))
            <div class="flash-message text-lg font-bold mb-4 absolute left-[20%] top-32 z-10">
                {{ session('message') }}
            </div>
        @endif

        @foreach ($posts as $post)
            <div
                class="glow-wrap neon-box floating mouse-reactive-flare mt-4 p-8 w-full rounded-5xl shadow-md {{ $loop->index % 2 == 0 ? 'md:w-2/3 md:ml-auto' : 'md:w-1/3' }}">
                <div class="md:text-left floating-glow" style="--i: {{ $loop->index }}">
                    <!-- アイコンと名前 -->
                    <div class="flex items-center space-x-1 pl-4">
                        <!-- アイコン表示 -->
                        <img src="{{ $post->user->icon ? Storage::url($post->user->icon) : asset('images/kanu.png') }}"
                            class="w-12 h-12 rounded-full object-cover glow-icon">
                        <!-- 名前（ホバーでメッセージ表示） -->
                        <h2 class="p-4 text-lg font-semibold relative group">
                            {{ $post->user->name }}
                            <!-- ホバー時に表示する一言メッセージ -->
                            <span
                                class="absolute left-8 bottom-12 mb-2 hidden group-hover:block bg-transparent text-[#65ecb1] text-sm rounded-lg shadow-md whitespace-nowrap glow-bio">
                                {{ $post->user->bio }}
                            </span>
                        </h2>
                    </div>

                    {{-- <hr class="w-full"> --}}
                    <div class="neon-separator w-full h-1 my-4"></div>
                    <div class="pl-4">
                        <p class="mt-4 p-4">
                            {{ $post->content }}
                        </p>

                        @if ($post->album_image_url || ($post->track_name && $post->artist_name))
                            <div class="flex items-center mt-2 space-x-4">
                                <img src="{{ $post->album_image_url }}" alt="アルバム画像"
                                    style="width: 70px; height: 70px;" class="object-cover rounded">
                            </div>
                        @endif

                        @if ($post->track_name && $post->artist_name)
                            <div class="flex flex-col">
                                <p class="ml-4 text-sm">曲名：{{ $post->track_name }}</p>
                                <p class="ml-4 text-sm">アーティスト名：{{ $post->artist_name }}</p>
                            </div>
                            @if ($post->preview_url)
                                <div class="ml-4 mt-2">
                                    <audio controls>
                                        <source src="{{ $post->preview_url }}" type="audio/mpeg">
                                        このブラウザは audio 要素に対応していません。
                                    </audio>
                                </div>
                            @endif
                            @if ($post->spotify_track_id)
                                <a href="https://open.spotify.com/track/{{ $post->spotify_track_id }}" target="_blank"
                                    class="text-pink-500 underline spotify-pink text-lg">
                                    <i class="fab fa-spotify ml-2 text-green-500"></i> Spotifyで開く
                                </a>
                            @endif
                        @endif

                        <div class="p-4 text-sm font-semibold">
                            <p>
                                {{ $post->created_at }}
                            </p>
                        </div>
                        @if (Auth::id() === $post->user_id)
                        <div class="flex justify-start gap-4">
                            <a href="{{ route('post.edit', $post) }}" class="inline-block">
                                <button class="edit-button">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                            <a href="{{ route('post.delete', $post) }}" class="inline-block">
                                <button class="trash-icon">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="h-20"></div>
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/index-earth.js'])

    <script>
        window.isLoggedIn = "{{ auth()->check() ? 'true' : 'false' }}";
    </script>
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
