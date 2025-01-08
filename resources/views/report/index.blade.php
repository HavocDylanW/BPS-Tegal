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
                                <span
                                    class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Laporan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div
                class="w-full drop-shadow-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="text-left pt-2 pb-6">
                    @if (Auth::user()->roles->contains('name', 'Super Admin'))
                        <a href="{{ route('report.export') }}"
                            class="text-white drop-shadow-xl bg-[#f18f01] hover:bg-[#bd8229] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Export ke Excel
                        </a>
                    @endif
                </div>
                <!-- Table Tugas -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nama Kegiatan</th>
                                <th scope="col" class="px-4 py-3">Nama Team</th>
                                <th scope="col" class="px-4 py-3">Target</th>
                                <th scope="col" class="px-4 py-3">Realisasi</th>
                                <th scope="col" class="px-4 py-3">Satuan</th>
                                <th scope="col" class="px-4 py-3">Batas Waktu</th>
                                {{-- <th scope="col" class="px-4 py-3">Tanggal Realisasi</th> --}}
                                <th scope="col" class="px-4 py-3">Keterangan</th>
                                {{-- <th scope="col" class="px-4 py-3 text-center">Aksi</th> --}}
                            </tr>
                        </thead>
                        <!-- Tbody -->
                        <tbody>
                            @foreach ($assignments as $assignment)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a class="hover:underline"
                                            href="{{ route('assignments.submissions', $assignment->id) }}">{{ $assignment->judul }}</a>
                                    </th>
                                    <td class="px-4 py-4">{{ $assignment->team->name }}</td>
                                    <td class="px-4 py-4 text-center">{{ $assignment->target }}</td>
                                    <td class="px-4 py-4 text-center">
                                        {{ $assignment->submissions->last()->realisasi ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-4 text-center">{{ $assignment->satuan }}</td>
                                    <td class="px-4 py-4 text-center">{{ $assignment->tgl_selesai->format('d-m-Y') }}</td>
                                    {{-- <td class="px-4 py-4 text-center">
                                @php
                                    $lastSubmission = $assignment->submissions->last();
                                @endphp
                                {{ $lastSubmission && $lastSubmission->tgl_realisasi ? $lastSubmission->tgl_realisasi->format('d-m-Y') : 'N/A' }}
                            </td> --}}
                                    <td class="px-4 py-4">{{ $assignment->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $assignments->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
