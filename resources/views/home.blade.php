@extends('layouts.app')

@section('styles')
    <style>
        #chartData,
        #pieChartData {
            max-width: 100%;
        }

        .charts-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .outer-border {
            width: 50%;
            /* height: 70%; */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            border: 2px solid #adb2b6;
            border-radius: 20px;
            box-sizing: border-box;
            box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.20);
            margin-top: 20px;

        }

        .data-display {
            display: inline-block;
            margin-left: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            color: #007bff;
            font-size: 12px;
            border-radius: 5px;
        }

        .dropdown-blue {
            color: #007bff;
        }

        .outer-border:first-child {
            margin-right: 10px;
        }

        .outer-border:last-child {
            margin-left: 10px;
        }
    </style>
@endsection

@section('nav-title')
    Dashboard
@endsection

@section('content')
    <div class="content">
        <div class="md:grid md:grid-cols-3 md:gap-2">
            <div class="p-2 md:col-span-2 rounded-lg border shadow-sm my-2">
                <div class="overflow-auto p-2">
                    <div class="flex justify-between">
                        <select id="tahunDropdownLinechart" class="border border-gray-200 rounded-md font-bold text-gray-500"
                            onchange="changeLinechartYear()">
                            <option value="0" hidden>Memuat...</option>
                        </select>
                        <div class="data-display" id="targetDataDisplay"></div>
                        <div class="data-display" id="aktualDataDisplay"></div>

                        <button onclick="selectLinechartExportFormat()"
                            class="justify-end ml-5 relative z-30 inline-flex items-center px-6 py-2.5 font-bold text-gray-500 transition-all duration-500 border border-gray-200 rounded-md cursor-pointer group ease bg-gradient-to-b from-white to-gray-50 hover:from-gray-50 hover:to-white active:to-white">
                            <span
                                class="w-full h-0.5 absolute bottom-0 group-active:bg-transparent left-0 bg-gray-100"></span>
                            <span
                                class="h-full w-0.5 absolute bottom-0 group-active:bg-transparent right-0 bg-gray-100"></span>
                            Export
                        </button>

                        <a href="javascript:settingTarget();">
                            <button
                                class="justify-end ml-5 relative z-30 inline-flex items-center w-auto px-6 py-2.5 font-bold text-gray-500 transition-all duration-500 border border-gray-200 rounded-md cursor-pointer group ease bg-gradient-to-b from-white to-gray-50 hover:from-gray-50 hover:to-white active:to-white">
                                <span
                                    class="w-full h-0.5 absolute bottom-0 group-active:bg-transparent left-0 bg-gray-100"></span>
                                <span
                                    class="h-full w-0.5 absolute bottom-0 group-active:bg-transparent right-0 bg-gray-100"></span>
                                Set Target
                            </button>
                        </a>
                    </div>
                </div>

                <div>
                    <canvas id="chartData" width="100" height="300"></canvas>
                </div>
            </div>
            <div class="p-2 rounded-lg border shadow-sm my-2">
                <div class="overflow-auto p-2">
                    <div class="flex justify-between">
                        <select id="tahunDropdownPiechart" class="border border-gray-200 rounded-md font-bold text-gray-500"
                            onchange="changePiechartYear()">
                            <option value="0" hidden>Memuat...</option>
                        </select>
                        <div class="data-display" id="totalTargetDataDisplay"></div>
                        <div class="data-display" id="totalAktualDataDisplay"></div>
                        <button onclick="selectpiechartExportFormat()"
                            class="justify-end ml-5 relative z-30 inline-flex items-center px-6 py-2.5 font-bold text-gray-500 transition-all duration-500 border border-gray-200 rounded-md cursor-pointer group ease bg-gradient-to-b from-white to-gray-50 hover:from-gray-50 hover:to-white active:to-white">
                            <span
                                class="w-full h-0.5 absolute bottom-0 group-active:bg-transparent left-0 bg-gray-100"></span>
                            <span
                                class="h-full w-0.5 absolute bottom-0 group-active:bg-transparent right-0 bg-gray-100"></span>
                            Export
                        </button>
                    </div>
                </div>

                <div>
                    <canvas id="pieChartData" width="100" height="250"></canvas>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/dashboard/index.js"></script>
@endsection
