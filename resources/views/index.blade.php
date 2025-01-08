@extends('layouts.app')

@section('content')
    <div class="p-4 sm:ml-64 mt-14">
        {{-- <section class="mt-16 mb-2 px-2 sm:px-7">
            <div id="alert-additional-content-1"
                class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium">Selamat Datang di Sistem Monitoring SAKIP Tegal,
                        {{ Auth::user()->name }}!
                    </h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                    More info about this info alert goes here. This example text is going to run a bit longer so that you
                    can
                    see how spacing within an alert works with this kind of content.
                </div>
                <div class="flex">
                    <button type="button"
                        class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 14">
                            <path
                                d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                        </svg>
                        View more
                    </button>
                    <button type="button"
                        class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                        data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                        Dismiss
                    </button>
                </div>
            </div>
        </section> --}}

        <section class="p-4 sm:p-7">
            <p class="text-4xl font-bold text-gray-900 dark:text-white">Dashboard</p>
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
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span
                                    class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Dashboard</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="md:flex md:col md:columns-3 gap-3 grid grid-rows-1">
                <div
                    class="w-full p-6 drop-shadow-2xl bg-white border border-blue-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-blue-800 dark:text-white">Total seluruh tugas
                    </h5>
                    <h5 class="mb-3 text-7xl font-bold tracking-tight text-blue-800 dark:text-white">
                        {{ $userAssignmentCount }}
                    </h5>
                </div>
                <div
                    class="w-full p-6 drop-shadow-2xl bg-white border border-blue-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-blue-800 dark:text-white">Total tugas yang
                        sudah
                        di
                        kerjakan</h5>
                    <h5 class="mb-3 text-7xl font-bold tracking-tight text-blue-800 dark:text-white">
                        {{ $userSubmissionCount }}
                    </h5>
                </div>
                <div
                    class="w-full p-6 drop-shadow-2xl bg-white border border-blue-300 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-blue-800 dark:text-white">Nama Team</h5>
                    <h5 class="mb-3 text-3xl font-bold tracking-tight text-blue-800 dark:text-white">
                        {{ $userTeamName->name ?? 'Not assigned to any team' }}

                    </h5>
                </div>
            </div>
        </section>

        <section class="p-4 sm:p-7">
            <div class="max-w-full w-full bg-white drop-shadow-2xl rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-blue-300 dark:border-gray-700">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 rounded-lg bg-blue-800 dark:bg-gray-700 flex items-center justify-center me-3">
                            <svg class="w-6 h-6 text-white dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="leading-none text-lg md:text-2xl font-bold text-gray-900 dark:text-white pb-1">
                                Progress
                                Realisasi
                                Pekerjaan Berdasarkan Tim Kerja BPS Kota Tegal</h5>
                            <p class="text-sm font-normal text-[#99c24d] dark:text-gray-400">Triwulan 4</p>
                        </div>
                    </div>
                    <div>
                        {{-- <span
                            class="bg-[#99c24d] text-black text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            42.5%
                        </span> --}}
                    </div>
                </div>

                {{-- <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Money spent:</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">$3,232</dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Conversion rate:</dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold">1.2%</dd>
                    </dl>
                </div> --}}

                <div id="column-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        {{-- <select id="quarterSelect"
                        class="text-sm font-medium text-[#99c24d] dark:text-gray-400 hover:text-gray-900 inline-flex items-center dark:hover:text-white">
                        <option value="1" {{ $quarter == 1 ? 'selected' : '' }}>January - March</option>
                        <option value="2" {{ $quarter == 2 ? 'selected' : '' }}>April - June</option>
                        <option value="3" {{ $quarter == 3 ? 'selected' : '' }}>July - September</option>
                        <option value="4" {{ $quarter == 4 ? 'selected' : '' }}>October - December</option>
                    </select> --}}

                        <div class="inline-flex items-center dark:hover:text-white">
                            <select id="yearSelect"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border-0 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 bg-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($years as $yearOption)
                                    <option value="{{ $yearOption }}" {{ $year == $yearOption ? 'selected' : '' }}>
                                        {{ $yearOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="inline-flex items-center dark:hover:text-white">
                            <select id="quarterSelect"
                                class="block w-full p-2 mb-6 text-sm text-gray-900 border-0 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 bg-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1" {{ $quarter == 1 ? 'selected' : '' }}>January - March</option>
                                <option value="2" {{ $quarter == 2 ? 'selected' : '' }}>April - June</option>
                                <option value="3" {{ $quarter == 3 ? 'selected' : '' }}>July - September</option>
                                <option value="4" {{ $quarter == 4 ? 'selected' : '' }}>October - December</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @section('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const yearSelect = document.getElementById('yearSelect');
                const quarterSelect = document.getElementById('quarterSelect');

                // Handle year change
                yearSelect.addEventListener('change', function() {
                    const selectedYear = this.value;
                    const selectedQuarter = quarterSelect.value; // Get the selected quarter
                    window.location.href = `?year=${selectedYear}&quarter=${selectedQuarter}`;
                });

                // Handle quarter change
                quarterSelect.addEventListener('change', function() {
                    const selectedQuarter = this.value;
                    const selectedYear = yearSelect.value; // Get the selected year
                    window.location.href = `?year=${selectedYear}&quarter=${selectedQuarter}`;
                });

                // Your chart rendering logic here
                const teamNames = {!! json_encode($teamNames) !!};
                const totalTargets = {!! json_encode($totalTargets) !!};
                const totalRealisasi = {!! json_encode($totalRealisasi) !!};

                const TargetData = teamNames.map((teamName, index) => ({
                    x: teamName,
                    y: totalTargets[index] || 0
                }));

                const RealisasiData = teamNames.map((teamName, index) => ({
                    x: teamName,
                    y: totalRealisasi[index] || 0
                }));

                const options = {
                    colors: ["#006e90", "#99c24d"],
                    series: [{
                            name: "Target",
                            color: "#006e90",
                            data: TargetData,
                        },
                        {
                            name: "Realisasi",
                            color: "#99c24d",
                            data: RealisasiData,
                        }
                    ],
                    chart: {
                        type: "bar",
                        height: "320px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    xaxis: {
                        categories: teamNames,
                    },
                };

                const chart = new ApexCharts(document.querySelector("#column-chart"), options);
                chart.render();
            });
        </script>
    </div>
@endsection
@endsection

{{-- {!! json_encode($team) !!} --}}
