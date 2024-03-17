@extends('layouts.app')

@section('content')
    <x-site.header>{{ __('Manage Users') }}</x-site.header>

    <div class="px-5 mx-auto">
        <div class="my-6 bg-white rounded-lg shadow-md">
            <table class="w-full text-left border-collapse">
                <!-- Table Header -->
                <thead class="text-white bg-gray-900 rounded-lg">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tl bg-grey-lightest text-grey-dark border-grey-light">Name</th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light">Email</th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light">Role</th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tr bg-grey-lightest text-grey-dark border-grey-light">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b border-grey-light">{{ $user->name }}</td>
                            <td class="px-6 py-4 border-b border-grey-light">{{ $user->email }}</td>
                            <td class="px-6 py-4 border-b border-grey-light">{{ $user->role }}</td>
                            <td class="flex justify-start px-6 py-4 space-x-2 border-b border-grey-light">
                                <a href="{{ route('users.edit', $user) }}" class="px-2 py-1 text-sm text-white bg-purple-800 rounded hover:bg-purple-950 focus:outline-none focus:shadow-outline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="px-5 text-right">
        <a href="{{ route('dashboard') }}" class='px-2 py-1 text-sm text-white bg-gray-500 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline'>Back</a>
    </div>
@endsection