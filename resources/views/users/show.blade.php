@extends('layouts.app')

@section('nav-title')
    <a href="/users">Users /</a>
    Show Users
@endsection

@section('content')
    <div class="min-h-screen min-w-full flex flex-col sm:justify-center overflow-auto">
        <div class="sm:max-w-[540px] container mx-auto">
            <div class="p-5 border rounded-lg min-w-full bg-white shadow sm:my-4">

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-semibold text-gray-900">
                        Name
                    </label>
                    <input type="text" id="title" name="title" value="{{ $user->name }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">
                        Email
                    </label>
                    <input type="text" value=" {{ $user->email }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">
                        Roles
                    </label>
                    @foreach ($user->roles as $role)
                        <input type="text" value=" {{ $role->name }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            readonly>
                    @endforeach
                </div>
                <div class="flex">
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Ubah</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
