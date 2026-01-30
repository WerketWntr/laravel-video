<div>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed top-0 left-0 w-full z-50 ">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a wire:navigate class="font-mono text-2xl text-gray-800" href="{{ route('home') }}">
                            {{ config('app.name') }}
                        </a>
                    </div>
                </div>

                <!-- Search -->
                <div class="mt-2 flex-items-center flex-grow-1">
                    <div class="relative">
                        <form method="GET" action="{{ route('search') }}">
                            <x-input autocomplete="off" wire:model.live="query" id="query" name="query" type="search" placeholder="Search">
                                <x-slot:append>
                                    <x-button type="submit" icon="fas.search" class="btn-primary rounded-l-none"/>
                                </x-slot:append>
                            </x-input>
                            @if(strlen($query)>0 && count($searchResults) > 0)
                                <div class="absolute w-full bg-white mt-1 border shadow-lg rounded z-50">
                                    @foreach($searchResults as $result)
                                        <div wire:click="setQuery('{{ $result['title'] }}">
                                            {{ $result['title'] }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </form>
                    </div>
                </div>


                @guest
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                @endguest

                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">

                        @auth
                            <x-button label="Upload Video" @click="$wire.dispatch('toggleModal')"
                                      class="mr-2 font-medium text-base bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition"/>
                        @endauth
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown>
                                <x-slot:trigger>
                                    <div class="flex items-center ml-5 cursor-pointer select-none">
                                        <span
                                            class="mr-2 font-medium text-base text-gray-800">{{ auth()->user()->name }}</span>
                                        <img src="{{ auth()->user()->profile_photo_url }}"
                                             alt="User avatar"
                                             class="w-8 h-8 rounded-full focus:outline-none focus:border-gray-300 transition">
                                    </div>
                                </x-slot:trigger>

                                <x-mary-menu-item title="Channel"
                                                  icon="fas.user"
                                                  link="{{ route('channel.show', auth()->user()) }}"/>

                                <x-mary-menu-item title="Account Settings"
                                                  icon="fas.cog"
                                                  link="{{ route('profile.show') }}"/>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-mary-menu-item href="{{ route('logout') }}"
                                                      icon="fas.arrow-right-to-bracket"
                                                      @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-mary-menu-item>
                                </form>
                            </x-dropdown>
                        </div>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </nav>
    <!-- Sidebar -->
    <aside aria-label="Sidebar"
           class="fixed top-0 left-0 z-40 w-64 pt-20 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('home') }}"
                       wire:navigate
                       {{ request()->routeIs('home') ? 'aria-current="page"' : '' }}
                       class="{{request()->routeIs('home') ? 'bg-gray-900 text-white hover:bg-gray-700' : ''}} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-icon name="fas.home" class="w-5 h-5"></x-icon>
                        <span class="flex-1 ms-3 whitespace-nowrap">Home</span>
                    </a>

                    <a href="{{ route('trending') }}"
                       wire:navigate
                       {{ request()->routeIs('trending') ? 'aria-current="page"' : '' }}
                       class="{{request()->routeIs('trending') ? 'bg-gray-900 text-white hover:bg-gray-700' : ''}} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <x-icon name="fas.hashtag" class="w-5 h-5"></x-icon>
                        <span class="flex-1 ms-3 whitespace-nowrap">Trending</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <livewire:upload-video/>
</div>
