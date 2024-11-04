<!-- resources/views/assignment/submissions.blade.php -->
@extends('layouts.app')

@section('content')
    <section class="px-10 py-2">
        <p class="text-4xl my-5 font-bold text-gray-900 dark:text-white">Submission Data</p>
        <div
            class="w-full drop-shadow-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="relative overflow-x-auto shadow-xl sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">User </th>
                            <th scope="col" class="px-6 py-3">Realisasi</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Link Tugas</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pengumpulan</th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignment->submissions as $submission)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ $submission->user->name }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
