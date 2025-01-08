<!-- resources/views/assignment/submissions.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <section class="p-4 sm:p-7">
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
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="/assignments"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Tugas</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Data
                                    Tugas</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div
                class="w-full drop-shadow-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative overflow-x-auto shadow-xl sm:rounded-lg">
                    <form action="{{ route('assignments.submissions', $assignment->id) }}" method="GET" class="mb-5">
                        <label for="filter" class="mr-2 text-gray-700 dark:text-gray-300">Filter by Approval
                            Status:</label>
                        <select name="filter" id="filter" onchange="this.form.submit()"
                            class="px-3 py-2 border border-gray-300 rounded-md dark:bg-gray-800 dark:text-white">
                            <option value="">All</option>
                            <option value="0" {{ request('filter') == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Approved</option>
                            <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">User</th>
                                <th scope="col" class="px-6 py-3">Realisasi</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Link Tugas</th>
                                <th scope="col" class="px-6 py-3">Tanggal Pengumpulan</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Komentar</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Approval</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submissions as $submission)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ $submission->user->name }}
                                        @foreach ($submission->user->roles as $role)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">{{ $submission->realisasi }}</td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                        <a href="{{ $submission->link_tugas }}" target="_blank"
                                            class="text-blue-600 hover:underline">View Link</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $submission->created_at ? $submission->created_at->format('d-m-Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ $assignment->keterangan ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                        {{ $submission->approval_status_label ?? 'Pending' }}
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                        {{-- @if (auth()->user()->roles->contains('name', 'Admin'))
                                            <form method="POST"
                                                action="{{ route('submission.updateApprovalStatus', $submission->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="approval_status"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    onchange="this.form.submit()">
                                                    <option value="0"
                                                        {{ $submission->approval_status == 0 ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $submission->approval_status == 1 ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="2"
                                                        {{ $submission->approval_status == 2 ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </form>
                                        @endif --}}
                                        @if (auth()->id() === $submission->assignment->team->leader_id)
                                            <form method="POST" class="inline"
                                                action="{{ route('submission.updateApprovalStatus', $submission->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select name="approval_status"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    onchange="this.form.submit()">
                                                    <option value="0"
                                                        {{ $submission->approval_status == 0 ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="1"
                                                        {{ $submission->approval_status == 1 ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="2"
                                                        {{ $submission->approval_status == 2 ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Not Authorized</span>
                                        @endif
                                        @if (Auth::id() === $submission->user_id)
                                            <div>
                                                <a href="{{ route('submissions.edit', $submission->id) }}"
                                                    class="px-3 py-2 mt-2 inline-flex items-center text-sm font-medium text-center text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-md dark:focus:ring-yellow-900">Edit</a>
                                            </div>
                                        @endif
                                        {{-- @if (Auth::user()->roles->contains('name', 'Admin') || Auth::user()->roles->contains('name', 'Employee'))
                                            <div>
                                                <a href="{{ route('submissions.edit', $submission->id) }}"
                                                    class="px-3 py-2 mt-2 inline-flex items-center text-sm font-medium text-center text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-md dark:focus:ring-yellow-900">Edit</a>
                                            </div>
                                        @endif --}}
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
