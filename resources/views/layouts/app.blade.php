<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('scripts') <!-- Make sure your scripts are loaded after Vite -->
</head>


<body class="bg-gray-100 dark:bg-gray-950">
    <!-- Navigation -->
    <nav class="fixed top-0 z-50 w-full bg-blue-800 border-b border-blue-800 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="{{ asset('assets/imgs/LambangBPS.svg') }}" class="h-9 me-3" alt="Logo BPS" />
                        <span class="self-center text-sm font-bold sm:text-sm whitespace-nowrap text-white">BADAN
                            PUSAT
                            STATISTIK<br>KOTA TEGAL</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="me-5">
                            <button id="theme-toggle" type="button"
                                class="md:me-5 text-gray-200 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('images/default-profile.png') }}"
                                    alt="{{ Auth::user()->name }}">
                            </button>
                        </div>
                        <div class="px-4" role="none">
                            <p class="text-sm text-gray-200 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-200 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="/user/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-user').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-800 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-800 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/dashboard"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <svg class="w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('dashboard') ? 'text-blue-800' : 'text-white' }}"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span
                            class="ms-3 {{ request()->routeIs('dashboard') ? 'text-blue-800 dark:text-orange-400' : 'text-white rounded hover:bg-blue-800 md:hover:bg-transparent md:hover:text-blue-800 dark:text-white md:dark:hover:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/assignments"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('assignments.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('assignments.index') ? 'text-blue-800' : 'text-white' }}"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span
                            class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('assignments.index') ? 'text-blue-800 dark:text-orange-400' : 'text-white rounded hover:bg-blue-800 md:hover:bg-transparent md:hover:text-blue-800 dark:text-white md:dark:hover:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Tugas</span>
                    </a>
                </li>
                <li>
                    <a href="/reports"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('report.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('report.index') ? 'text-blue-800' : 'text-white' }}"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span
                            class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('report.index') ? 'text-blue-800 dark:text-orange-400' : 'text-white rounded hover:bg-blue-800 md:hover:bg-transparent md:hover:text-blue-800 dark:text-white md:dark:hover:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Laporan</span>
                    </a>
                </li>
                @if (Auth::user()->roles->first()->name === 'Super Admin')
                    <li>
                        <a href="/users"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('users.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('users.index') ? 'text-blue-800' : 'text-white' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span
                                class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('users.index') ? 'text-blue-800 dark:text-orange-400' : 'text-white rounded hover:bg-blue-800 md:hover:bg-transparent md:hover:text-blue-800 dark:text-white md:dark:hover:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="/teams"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs('teams.index') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <svg class="flex-shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white {{ request()->routeIs('teams.index') ? 'text-blue-800' : 'text-white' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 18 20">
                                <path
                                    d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                            </svg>
                            <span
                                class="flex-1 ms-3 whitespace-nowrap {{ request()->routeIs('teams.index') ? 'text-blue-800 dark:text-orange-400' : 'text-white rounded hover:bg-blue-800 md:hover:bg-transparent md:hover:text-blue-800 dark:text-white md:dark:hover:text-orange-400 dark:hover:bg-orange-400 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }}">Teams</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </aside>

    {{-- <nav class="bg-[#000B58] border-gray-200 dark:bg-gray-900">
        <div class="w-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/dashboard" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/imgs/LambangBPS.svg') }}" class="h-8" alt="Flowbite Logo" />
                <span
                    class="self-center leading-5 sm:text-md text-sm italic font-semibold whitespace-wrap text-white dark:text-white">BADAN
                    PUSAT
                    STATISTIK<br>KOTA TEGAL</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button id="theme-toggle" type="button"
                    class="md:me-5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('profile/templates/woman.jpeg') }}"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span
                            class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                    </div>
                    <!-- User Menu -->
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @switch(auth()->user()->roles->first()->name)
                            @case('Super Admin')
                                <li>
                                    <a href="/user/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-user').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            @break

                            @case('Admin')
                                <li>
                                    <a href="/user/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-user').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            @break

                            @case('Employee')
                                <li>
                                    <a href="/user/profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-user').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                        out</a>
                                </li>
                            @break

                            @default
                        @endswitch
                    </ul>
                </div>
                <div class="sm:flex hidden">
                    <div class="px-3 font-medium text-white dark:text-white">
                        <!-- User Name, User Roles -->
                        <div>{{ Auth::user()->name }}</div>
                        <div class="flex items-center text-sm text-gray-300 dark:text-gray-400">
                            <!-- Role Indicator -->
                            @if (Auth::user()->roles->first()->name === 'Employee')
                                <span class="flex w-3 h-3 me-1.5 bg-green-500 rounded-full"
                                    style="align-self: center; margin-top: 2px;"></span>
                            @elseif(Auth::user()->roles->first()->name === 'Admin')
                                <span class="flex w-3 h-3 me-1.5 bg-yellow-300 rounded-full"
                                    style="align-self: center; margin-top: 2px;"></span>
                            @elseif(Auth::user()->roles->first()->name === 'Super Admin')
                                <span class="flex w-3 h-3 me-1.5 bg-red-500 rounded-full"
                                    style="align-self: center; margin-top: 2px;"></span>
                            @endif
                            {{ Auth::user()->roles->first()->name ?? 'User' }}
                        </div>
                    </div>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <!-- Navigation Menu -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="flex flex-col md:divide-y-0 divide-y divide-slate-700 font-medium py-3.5 md:p-0 mt-4 rounded-lg bg-[#000B58] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#000B58] dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <!-- Role Indicator -->
                        @if (Auth::user()->roles->first()->name === 'Employee')
                            <a href="/dashboard"
                                class="{{ request()->routeIs('dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @elseif(Auth::user()->roles->first()->name === 'Admin')
                            <a href="/dashboard"
                                class="{{ request()->routeIs('dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @elseif(Auth::user()->roles->first()->name === 'Super Admin')
                            <a href="/dashboard"
                                class="{{ request()->routeIs('dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @endif
                    </li>
                    @if (Auth::user()->roles->first()->name === 'Super Admin')
                        <a href="/teams"
                            class="{{ request()->routeIs('teams.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                            aria-current="page">Teams</a>
                        <a href="/users"
                            class="{{ request()->routeIs('users.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                            aria-current="page">Users</a>
                    @endif
                    <li>
                        <a href="/assignments"
                            class="{{ request()->routeIs('assignments.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0">Assignment</a>
                    </li>
                    <li>
                        <a href="/reports"
                            class="{{ request()->routeIs('reports.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0">Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}

    <!-- Notification -->
    <section class="fixed bottom-5 right-5 z-50 w-full max-w-xs">
        @if (session('success'))
            <div id="toast-success"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
    </section>

    <section>
        @if (session('error'))
            <div class="fixed mt-16 top-0 z-50 p-4 sm:p-7 alert" id="toast-error">
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Peringatan Error!</span> {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section>
        @if ($errors->has('realisasi'))
            <div class="fixed mt-16 top-0 z-50 p-4 sm:p-7 alert" id="toast-error">
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Peringatan Error!</span> {{ $errors->first('realisasi') }}
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- Notification Script -->
    <script>
        // Check if the notification is present
        const notification = document.getElementById('toast-success');
        if (notification) {
            // Set a timeout to fade out the notification after 3 seconds (3000 milliseconds)
            setTimeout(() => {
                notification.style.opacity = '0'; // Start fading out
                // After the fade-out transition, hide the notification
                setTimeout(() => {
                    notification.style.display = 'none'; // Hide the notification
                }, 500); // This should match the duration of the fade-out transition
            }, 3000);
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alert = document.getElementById('toast-error');

            if (alert) {
                // Show the alert with slide down effect
                alert.classList.add('show');

                // Set a timeout to hide the alert after 3 seconds
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('hide');

                    // Remove the alert from the DOM after the animation is complete
                    setTimeout(() => {
                        alert.remove();
                    }, 500); // Match this duration with the CSS transition duration
                }, 3000); // Alert stays visible for 3 seconds
            }
        });
    </script>

    <!-- Notification Styling -->

    <style>
        /* CSS to handle the transition */
        #alert-3 {
            transition: opacity 0.5s ease;
            /* Adjust the duration as needed */
        }
    </style>

    <style>
        .alert {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            left: 50%;
            /* Center horizontally */
            transform: translateX(-50%) translateY(-20px);
            /* Adjust for centering */
        }

        .alert.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
            /* Keep centered when shown */
        }

        .alert.hide {
            opacity: 0;
            transform: translateX(-50%) translateY(-20px);
            /* Keep centered when hiding */
        }
    </style>

    <!-- Logout Form -->
    <form id="logout-user" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Yield for Layouts -->
    <div>
        @yield('content')
    </div>
</body>
