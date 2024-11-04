@extends('layouts.app')

@section('content')
    <section>
        <!-- drawer component -->
        <div id="drawer-form"
            class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-form-label">
            <h5 id="drawer-form-label"
                class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                </svg>
                Buat Tugas Baru
            </h5>
            <button type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <!-- Form for creating an assignment -->
            <form method="POST" action="{{ route('assignments.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Assignment Judul -->
                <div class="mb-6">
                    <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Kegiatan</label>
                    <input type="text" id="judul" name="judul"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cth. Penyusunan Laporan Keuangan" required>
                </div>

                <!-- Assignment Target -->
                <div class="mb-6">
                    <label for="target"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Target</label>
                    <input type="number" id="target" name="target"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cth. 1" required>
                </div>

                <!-- Assignment Satuan -->
                <div class="mb-6">
                    <label for="satuan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                    <input type="text" id="satuan" name="satuan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cth. Laporan" required>
                </div>

                <!-- Assignment Keterangan -->
                <div class="mb-6">
                    <label for="keterangan"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="keterangan" name="keterangan" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="(Bisa dikosongkan)"></textarea>
                </div>

                <!-- Start Date -->
                <div class="mb-6">
                    <label for="tgl_mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Mulai</label>
                    <input type="date" id="tgl_mulai" name="tgl_mulai"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <!-- Due Date -->
                <div class="mb-6">
                    <label for="tgl_selesai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Selesai</label>
                    <input type="date" id="tgl_selesai" name="tgl_selesai"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <!-- Team Selection -->
                <div class="mb-6">
                    <label for="team_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pilih Tim
                    </label>

                    @if ($teams->isEmpty())
                        <!-- Show a message if no teams are available -->
                        <p class="text-sm text-red-500">Belum ada tim yang tersedia. Buat tim terlebih dahulu.</p>
                    @else
                        <!-- Show the select input if there are teams available -->
                        <select id="team_id" name="team_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>


                <!-- Submit Button -->
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Buat Tugas
                </button>
            </form>
        </div>
    </section>

    <section class="px-10 py-2">
        <p class="text-4xl my-5 font-bold text-gray-900 dark:text-white">Data Tugas</p>
        <div
            class="w-full drop-shadow-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <!-- drawer init and show button -->
            <div class="text-left py-2">
                @if (Auth::user()->roles->contains('name', 'Admin'))
                    <button
                        class="text-white drop-shadow-xl bg-[#f18f01] hover:bg-[#bd8229] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        type="button" data-drawer-target="drawer-form" data-drawer-show="drawer-form"
                        aria-controls="drawer-form">Tambah Tugas
                    </button>
                @endif
            </div>
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
                            <th scope="col" class="px-4 py-3">Tanggal Realisasi</th>
                            <th scope="col" class="px-4 py-3">Keterangan</th>
                            <th scope="col" class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
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
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $lastSubmission = $assignment->submissions->last();
                                    @endphp
                                    {{ $lastSubmission && $lastSubmission->tgl_realisasi ? $lastSubmission->tgl_realisasi->format('d-m-Y') : 'N/A' }}
                                </td>
                                <td class="px-4 py-4">{{ $assignment->keterangan }}</td>
                                <td class="text-center px-4 py-4">
                                    <a href="{{ route('submissions.create', ['assignment' => $assignment->id]) }}"
                                        class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</a>
                                    @if (Auth::user()->roles->contains('name', 'Admin'))
                                        <a href="{{ route('assignments.edit', $assignment->id) }}"
                                            class="px-3 py-2 text-sm font-medium text-center focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 rounded-md dark:focus:ring-yellow-900">Edit
                                            Komentar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
