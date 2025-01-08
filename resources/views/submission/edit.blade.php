@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        <section class="flex items-center justify-center p-4 sm:p-7">
            <form action="{{ route('submissions.update', $submission->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full max-w-sm">
                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <form action="{{ route('submissions.store') }}" method="POST" class="max-w-sm mx-auto">
                            @csrf
                            <label for="assignment_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Realisasi</label>
                            <div class="relative max-w-sm mb-5">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-autohide" datepicker datepicker-autohide type="text"
                                    name="tgl_realisasi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('link_tugas', $submission->tgl_realisasi) }}">
                            </div>
                            <div class="mb-5">
                                <label for="realisasi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update
                                    Realisasi</label>
                                <input type="integer" id="realisasi" name="realisasi"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('link_tugas', $submission->realisasi) }}" required />
                            </div>
                            <div class="mb-5">
                                <label for="link_tugas"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assignment
                                    Link</label>
                                <input type="url" id="link_tugas" name="link_tugas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ old('link_tugas', $submission->link_tugas) }}" required />
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                                Submission</button>
                            <a href="{{ route('assignments.submissions', $submission->id) }}"
                                class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
        </section>
    </div>
@endsection
