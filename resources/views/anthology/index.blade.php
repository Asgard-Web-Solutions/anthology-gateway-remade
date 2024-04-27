@extends('layouts.app')

@section('content')
    <x-site.header>{{ __('Manage Anthologies') }}</x-site.header>

    <div class="px-5 mx-auto">
        <div class="my-6 bg-white rounded-lg shadow-md">
            <table class="w-full text-left border-collapse">
                <!-- Table Header -->
                <thead class="text-white bg-gray-900 rounded-lg">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tl bg-grey-lightest text-grey-dark border-grey-light">Name</th>
                        <th class="hidden px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light sm:table-cell">Creator</th>
                        <th class="hidden px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light sm:table-cell">Publisher</th>
                        <th class="hidden px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light sm:table-cell">Status</th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tr bg-grey-lightest text-grey-dark border-grey-light">Actions</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody class="text-gray-700">
                    @foreach ($anthologies as $anthology)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b border-grey-light"><a href="{{ route('anthology.view', $anthology->id) }}" class="text-purple-600 underline hover:text-purple-900 hover:no-underline">{{ $anthology->name }}</a></td>
                            <td class="hidden px-6 py-4 border-b border-grey-light sm:table-cell">{{ $anthology->creator->email }}</td>
                            <td class="hidden px-6 py-4 border-b border-grey-light sm:table-cell"><a class="text-purple-600 underline hover:text-purple-900 hover:no-underline" href="{{ route('publisher.view', $anthology->publisher->id) }}">{{ $anthology->publisher->name }}</a></td>
                            <td class="hidden px-6 py-4 border-b border-grey-light sm:table-cell">{{ ucfirst($anthology->status->value) }}</td>
                            <td class="flex justify-start px-6 py-4 space-x-2 border-b border-grey-light">
                                <a href="{{ route('anthology.manage', $anthology->id) }}" class="px-2 py-1 text-sm text-white bg-purple-800 rounded hover:bg-purple-950 focus:outline-none focus:shadow-outline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="px-5 text-right">
        <a href="{{ route('settings') }}" class='px-2 py-1 text-sm text-white bg-gray-500 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline'>Back</a>
    </div>
@endsection