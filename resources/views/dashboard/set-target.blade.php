@extends('layouts.app')

@section('nav-title')
    Set Target
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <form action="{{ route('set-target') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tahun
                        </label>

                        <input type="text" value="{{ $year }}" name="year" id="year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            readonly>

                    </div>
                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Quarter 1
                        </label>
                        <input type="number" name="amount[]" {!! $edit ? "value=\"" . explode('-', $data['amount'])[0] . "\"" : '' !!}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Nominal Target" required>
                    </div>
                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Quarter 2
                        </label>
                        <input type="number" name="amount[]" {!! $edit ? "value=\"" . explode('-', $data['amount'])[1] . "\"" : '' !!}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Nominal Target" required>
                    </div>
                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Quarter 3
                        </label>
                        <input type="number" name="amount[]" {!! $edit ? "value=\"" . explode('-', $data['amount'])[2] . "\"" : '' !!}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Nominal Target" required>
                    </div>
                    <div class="mb-6">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Quarter 4
                        </label>
                        <input type="number" name="amount[]" {!! $edit ? "value=\"" . explode('-', $data['amount'])[3] . "\"" : '' !!}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan Nominal Target" required>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Set
                        Target</button>
                </form>
            </div>
        </div>
    </div>
@endsection
