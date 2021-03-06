@php
    $menuPublic = [
        ['text' => 'Registrasi', 'link' => route('registration'), 'active' => request()->routeIs('registration')],
        ['text' => 'Pendirian Koperasi', 'link' => route('cooperative.establishment'), 'active' => request()->routeIs('cooperative.establishment')],
        ['text' => 'Pendidikan Koperasi', 'link' => route('cooperative.education'), 'active' => request()->routeIs('cooperative.education')],
        ['text' => 'Jadwal pembinaan koperasi', 'link' => route('schedule'), 'active' => request()->routeIs('schedule')],
    ];

    $adminMenu = [
        ['text' => 'Menu Registrasi', 'link' => route('admin.registration')],
        ['text' => 'Menu Pendirian Koperasi', 'link' => route('admin.cooperative.establishment')],
        ['text' => 'Menu Advokasi', 'link' => route('admin.cooperative.advocacy')],
        ['text' => 'Menu Pendampingan', 'link' => route('admin.cooperative.accompaniment')],
        ['text' => 'Menu Pemeriksaan Kesehatan', 'link' => route('admin.cooperative.penkes')],
        ['text' => 'Menu Pendidikan Koperasi', 'link' => route('admin.cooperative.education')],
    ];

    $cooperativeMenu = [
        ['text' => 'Update Formulir', 'link' => route('cooperative.form.edit')],
        ['text' => 'Advokasi', 'link' => route('cooperative.advocacy')],
        ['text' => 'Pendampingan', 'link' => route('cooperative.accompaniment')],
        ['text' => 'Pemeriksaan Kesehatan', 'link' => route('cooperative.penkes')],
    ];
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16">
            <div class="flex flex-1">
                <!-- Logo -->
                <div class="flex-shrink-0 flex flex-row items-center font-bold text-gray-700">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="inline-block h-10 w-auto fill-current" />
                        <span class="ml-2">{{ config('app.name') }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>
                                        Menu Publik
                                    </div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @foreach ($menuPublic as $item)
                                    <x-dropdown-link :href="$item['link']">
                                        {{ __($item['text']) }}
                                    </x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @if(auth_check())
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <div class="hidden sm:flex sm:items-center">
                            <x-dropdown align="left" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>
                                            Menu {{ current_guard() == 'web' ? 'Admin' : 'Koperasi' }}
                                        </div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @php
                                        $list = current_guard() == 'web' ? $adminMenu : $cooperativeMenu;
                                    @endphp
                                    @foreach ($list as $item)
                                        <x-dropdown-link :href="$item['link']">
                                            {{ __($item['text']) }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Login & Register -->
            @if(!auth_check())
                <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        {{-- <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link> --}}
                    </div>
                </div>
            @endif


            <!-- Settings Dropdown -->
            @if(auth_check())
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    {{ current_auth()->name }}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Dashboard -->
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
            <x-dropdown align="left" width="48">
                <x-slot name="trigger">
                    <x-responsive-nav-link class="flex items-center">
                        <div>
                            {{ __('Menu Publik') }}
                        </div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </x-responsive-nav-link>
                </x-slot>
                <x-slot name="content">
                    @foreach ($menuPublic as $item)
                        <x-dropdown-link :href="$item['link']">
                            {{ __($item['text']) }}
                        </x-dropdown-link>
                    @endforeach
                </x-slot>
            </x-dropdown>
            @if(auth_check())
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <x-responsive-nav-link class="flex items-center">
                            <div>
                                Menu {{ current_guard() == 'web' ? 'Admin' : 'Koperasi' }}
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </x-responsive-nav-link>
                    </x-slot>
                    <x-slot name="content">
                        @php
                            $list = current_guard() == 'web' ? $adminMenu : $cooperativeMenu;
                        @endphp
                        @foreach ($list as $item)
                            <x-dropdown-link :href="$item['link']">
                                {{ __($item['text']) }}
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="mb-4">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
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
        @endauth
        @if(!auth_check())
            <div class="pt-4 pb-4 border-t border-gray-200">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
                </x-responsive-nav-link>
            </div>
        @endif
    </div>
</nav>
