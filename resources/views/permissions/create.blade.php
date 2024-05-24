@extends('layouts.app')

@section('nav-title')
    <a href="/permissions">Permissions /</a>
    Create Permisiion
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <form method="post" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Name
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="name . ." required>
                    </div>
                    <div class="mb-6">
                        <label for="display_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Display Name
                        </label>
                        <input type="text" id="display_name" name="display_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="display name . .">
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Description
                        </label>
                        <textarea name="description" id="description" class="w-full" rows="3" placeholder="description . ."></textarea>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
