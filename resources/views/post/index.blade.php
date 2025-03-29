<x-app-layout> {{-- style="background-image: url('{{ Js::from(Vite::asset('resources/js/app.js')) }}');> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800　leading-tight">
            一覧表示
        </h2>
    </x-slot>


    <div class="mx-auto px-6">
        @foreach ($posts as $post)
            <div
                class="mt-4 p-8 w-full rounded-2xl shadow-md {{ $loop->index % 2 == 0 ? 'md:w-2/3 md:ml-auto' : 'md:w-1/3' }}">
                <div class="md:text-left">
                    {{-- <div class="{{ $loop->index % 2 == 0 ? 'md:text-right' : 'md:text-left' }}"> --}}
                    <!-- アイコンと名前 -->
                    <div class="flex items-center space-x-4">
                        <!-- アイコン表示 -->
                        <img src="{{ $post->user->icon ? Storage::url($post->user->icon) : asset('images/default-icon.png') }}"
                            class="w-12 h-12 rounded-full object-cover">
                        <!-- 名前（ホバーでメッセージ表示） -->
                        <h2 class="p-4 text-lg font-semibold relative group">
                            {{ $post->user->name }}
                            <!-- ホバー時に表示する一言メッセージ -->
                            <span
                                class="absolute left-0 bottom-full mb-2 hidden group-hover:block bg-gray-700 text-white text-sm px-3 py-1 rounded-lg shadow-md">
                                {{ $post->user->bio }}
                            </span>
                        </h2>
                    </div>

                    <hr class="w-full">
                    <p class="mt-4 p-4">
                        {{ $post->content }}
                    </p>
                    <div class="p-4 text-sm font-semibold">
                        <p>
                            {{ $post->created_at }}
                        </p>
                    </div>
                    <div class="flex justify-start gap-2">
                        <a href="{{ route('post.edit', $post) }}" class="inline-block">
                            <x-primary-button>
                                編集
                            </x-primary-button>
                        </a>
                        <a href="{{ route('post.delete', $post) }}" class="inline-block">
                            <x-primary-button>
                                削除
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mb-4">
            {{ $posts->links() }}
        </div>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.isLoggedIn = "{{ auth()->check() ? 'true' : 'false' }}";
    </script>
</x-app-layout>
