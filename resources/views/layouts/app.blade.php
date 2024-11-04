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


<body class="bg-white dark:bg-gray-950">
    <nav class="bg-[#000B58] border-gray-200 dark:bg-gray-900">
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
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @switch(auth()->user()->roles->first()->name)
                            @case('Super Admin')
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                                </li>
                                <li>
                                    <a href="/superAdmin-dashboard/profile"
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
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                                </li>
                                <li>
                                    <a href="/admin-dashboard/profile"
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
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                                </li>
                                <li>
                                    <a href="/employee-dashboard/profile"
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
            {{-- Navigation Menu --}}
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul
                    class="flex flex-col md:divide-y-0 divide-y divide-slate-700 font-medium py-3.5 md:p-0 mt-4 rounded-lg bg-[#000B58] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-[#000B58] dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <!-- Role Indicator -->
                        @if (Auth::user()->roles->first()->name === 'Employee')
                            <a href="/e/dashboard"
                                class="{{ request()->routeIs('employee.dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @elseif(Auth::user()->roles->first()->name === 'Admin')
                            <a href="/a/dashboard"
                                class="{{ request()->routeIs('admin.dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @elseif(Auth::user()->roles->first()->name === 'Super Admin')
                            <a href="/sa/dashboard"
                                class="{{ request()->routeIs('superAdmin.dashboard') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0"
                                aria-current="page">Dashboard</a>
                        @endif
                    </li>
                    <li>
                        <a href="/assignments"
                            class="{{ request()->routeIs('assignments.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0">Assignment</a>
                    </li>
                    <li>
                        <a href="#"
                            class="{{ request()->routeIs('reports.index') ? 'text-[#F09319]' : 'text-white rounded hover:bg-[#F09319] md:hover:bg-transparent md:hover:text-[#F09319] dark:text-white md:dark:hover:text-[#F09319] dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700' }} block py-2 md:p-0">Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
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

    <style>
        /* CSS to handle the transition */
        #alert-3 {
            transition: opacity 0.5s ease;
            /* Adjust the duration as needed */
        }
    </style>

    <form id="logout-user" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <div>
        @yield('content')
    </div>
</body>
