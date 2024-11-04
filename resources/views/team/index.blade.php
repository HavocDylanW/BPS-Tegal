@extends('layouts.app')

@section('content')
    <section class="p-10">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <caption
                    class="p-5 text-xl font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Team kami
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite
                        products
                        designed to help you work and play, stay organized, get answers, keep in touch, grow your
                        business,
                        and
                        more.</p>
                </caption>
                <a href="{{ route('teams.create') }}" class="btn btn-primary">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                        Tim</button>
                </a>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Tim</th>
                        <th scope="col" class="px-6 py-3">Leader</th> <!-- Add this line to show leader -->
                        <th scope="col" class="px-6 py-3">Anggota</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $team->name }}
                            </th>
                            <td class="px-6 py-4">
                                <!-- Display team leader -->
                                <div class="flex items-center mb-2">
                                    <div class="relative w-6 h-6 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                        <svg class="absolute w-8 h-8 text-gray-400 -left-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="ml-2">{{ $team->leader->name ?? 'No Leader' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @foreach ($team->members as $member)
                                    <div class="flex items-center mb-2">
                                        <div
                                            class="relative w-6 h-6 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                            <svg class="absolute w-8 h-8 text-gray-400 -left-1" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="ml-2">{{ $member->name }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teams.edit', $team->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
