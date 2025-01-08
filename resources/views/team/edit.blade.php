@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <section class="flex items-center justify-center p-4 sm:p-7">
            <div class="w-full max-w-sm">
                <div
                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <form class="max-w-sm mx-auto" action="{{ route('teams.update', $team->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        @if ($errors->any())
                            <div class="mb-4 text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Tim</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Bunga Mawar" value="{{ old('name', $team->name) }}" required />
                        </div>

                        <div class="mb-4">
                            <label for="leader"
                                class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Select
                                Team Leader</label>
                            <div class="relative">
                                <button id="dropdownLeaderButton" data-dropdown-toggle="dropdownLeader"
                                    class="w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 flex items-center justify-between px-4 py-2"
                                    type="button">
                                    {{ $team->leader->name }} <!-- Display the current leader's name -->
                                    <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="dropdownLeader"
                                    class="z-10 hidden bg-white rounded-lg shadow w-full dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownLeaderButton">
                                        @foreach ($leaders as $leader)
                                            <li>
                                                <a href="#"
                                                    class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    onclick="selectLeader('{{ $leader->id }}', '{{ $leader->name }}')">
                                                    <img src="{{ $leader->profile_picture ? asset($leader->profile_picture) : asset('images/default-profile.png') }}"
                                                        alt="{{ $leader->name }}'s profile picture"
                                                        class="w-6 h-6 rounded-full mr-2">
                                                    {{ $leader->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="leader" id="selectedLeader" value="{{ $team->leader_id }}"
                                required>
                        </div>

                        <script>
                            function selectLeader(id, name) {
                                document.getElementById('selectedLeader').value = id;
                                document.getElementById('dropdownLeaderButton').innerText = name;
                                document.getElementById('dropdownLeader').classList.add('hidden');
                            }

                            // Optional: Close dropdown when clicking outside
                            document.addEventListener('click', function(event) {
                                const dropdown = document.getElementById('dropdownLeader');
                                const button = document.getElementById('dropdownLeaderButton');
                                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                    dropdown.classList.add('hidden');
                                }
                            });

                            // Show dropdown on button click
                            document.getElementById('dropdownLeaderButton').addEventListener('click', function() {
                                document.getElementById('dropdownLeader').classList.toggle('hidden');
                            });
                        </script>

                        <div class="mb-4">
                            <label for="members" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Add
                                Team
                                Members</label>
                            <button id="dropdownMembersButton" data-dropdown-toggle="dropdownMembers"
                                data-dropdown-placement="bottom"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">Select team members <svg class="w-2.5 h-2 .5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdownMembers" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                                <div class="p-3">
                                    <label for="input-group-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="input-group-search"
                                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search employees..." />
                                    </div>
                                </div>
                                <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMembersButton">
                                    @foreach ($availableEmployees as $employee)
                                        <li>
                                            <label
                                                class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                <div class="flex items-center">
                                                    <img class="w-6 h-6 me-2 rounded-full"
                                                        src="{{ $employee->profile_picture ? asset($employee->profile_picture) : asset('images/default-profile.png') }}"
                                                        alt="{{ $employee->name }}'s profile picture">
                                                    {{ $employee->name }}
                                                </div>
                                                <input type="checkbox" name="members[]" value="{{ $employee->id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500 ml-auto"
                                                    @if (in_array($employee->id, $lastTeamMembers)) checked @endif>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            Update Team
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
