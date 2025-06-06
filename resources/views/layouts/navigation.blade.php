<div id="particle-bg"></div>
<nav x-data="{ open: false }" class="border-pink-300 dark:border-pink-600" style="position: relative; z-index: 10;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="flex justify-between py-2">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')" class="glow-navigation">
                        Posts
                    </x-nav-link>
                    <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')" class="glow-navigation">
                        New Post Form
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="glow-navigation">
                        {{ __('Dashboard') }}
                    </x-nav-link> --}}
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="max-w-[110px] truncate mt-5 inline-flex items-center border-transparent text-sm leading-4 rounded-md planet-button transition ease-in-out duration-150 text-[#f7f7fb] text-glow-on-hover">
                            <div>{{ auth()->user()->name ?? 'Guest' }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-pink-400 hover:text-white hover:bg-pink-700/20 dark:hover:bg-pink-400/10 focus:outline-none focus:ring-2 focus:ring-pink-500 shadow-neon transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                投稿一覧
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                新規作成
            </x-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ optional($authUser)->name ?? 'ゲスト' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ optional($authUser)->email ?? '' }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/nav-particles.js')

</nav>
