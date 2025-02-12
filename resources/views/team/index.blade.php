@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <section class="p-4 sm:p-7">
            <!-- Judul Table -->
            <p class="text-4xl font-bold text-gray-900 dark:text-white">Data Tugas</p>
            <div class="mt-2 mb-5 sm:mb-10">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="/dashboard"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Home
                            </a>
                        </li>
                        {{-- <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="#"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Projects</a>
                            </div>
                        </li> --}}
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Teams</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div
                class="w-full drop-shadow-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div
                        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                        <div>
                            @if (Auth::user()->roles->contains('name', 'Super Admin'))
                                <a href="{{ route('teams.create') }}"
                                    class="text-white drop-shadow-xl bg-[#f18f01] hover:bg-[#bd8229] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                                    Tim
                                </a>
                            @endif
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for users">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Tim
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Member
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">{{ $team->name ?? 'No Leader' }}</div>
                                            <div class="font-normal text-gray-500">Dibentuk pada
                                                {{ $team->created_at ? $team->created_at->format('d F Y') : 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($team->leader)
                                            @if ($team->leader->profile_picture)
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ asset($team->leader->profile_picture) }}"
                                                    alt="{{ $team->leader->name }}">
                                            @else
                                                <img src="{{ asset('images/default-profile.png') }}"
                                                    alt="Default profile picture" class="w-10 h-10 rounded-full">
                                            @endif
                                        @else
                                            No Leader
                                        @endif
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">{{ $team->leader->name ?? 'No Leader' }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $team->leader->email ?? 'No Leader' }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <div class="flex -space-x-4 rtl:space-x-reverse">
                                            @foreach ($team->members as $member)
                                                @if ($member->profile_picture)
                                                    <!-- Check if profile_picture exists -->
                                                    <img class="w-7 h-7 rounded-full"
                                                        src="{{ asset($member->profile_picture) }}"
                                                        alt="{{ $member->name }}">
                                                @else
                                                    <img src="{{ asset('images/default-profile.png') }}"
                                                        alt="Default profile picture" class="w-7 h-7 rounded-full">
                                                @endif
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('teams.edit', $team->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
