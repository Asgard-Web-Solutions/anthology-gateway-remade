@extends('layouts.app')

@section('content')
    <div>
        <x-site.header>{{ __('Manage Social Media Services') }}</x-site.header>

        <div class="px-5 mx-auto">
            <div class="my-6 bg-white rounded-lg shadow-md">
                <table class="w-full text-left border-collapse">
                    <!-- Table Header -->
                    <thead class="text-white bg-gray-900 rounded-lg">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tl bg-grey-lightest text-grey-dark border-grey-light">Name</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light">Icon Class</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light">Base URL</th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tr bg-grey-lightest text-grey-dark border-grey-light">Actions</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody class="text-gray-700">
                        @foreach ($socials as $social)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border-b border-grey-light">{{ $social->name }}</td>
                                <td class="px-6 py-4 border-b border-grey-light">
                                    <i class="{{ $social->image }} text-2xl" data-ripple-light="true" data-tooltip-target="tooltip-{{ $social->name }}"></i>

                                    <div data-tooltip="tooltip-{{ $social->name }}" class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                        {{ $social->image }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border-b border-grey-light">{{ $social->base_url }}</td>
                                <td class="flex justify-start px-6 py-4 space-x-2 border-b border-grey-light">
                                    <x-button.primary-small href="{{ route('socials.edit', $social->id) }}" icon="fa-regular fa-pen-to-square">Edit</x-button.primary-small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-5 mx-auto">
            <div class="my-6 bg-white rounded-lg shadow-md">
                <table class="w-full text-left border-collapse">
                    <!-- Table Header -->
                    <thead class="text-white bg-gray-900 rounded-lg">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tl bg-grey-lightest text-grey-dark border-grey-light"><label id='name'>Name</label></th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light"><label id='image'>Icon Class</label></th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light"><label id='base_url'>Base URL</label></th>
                            <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tr bg-grey-lightest text-grey-dark border-grey-light">Add</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <form action="{{ route('socials.store') }}" method="POST">
                        @csrf
                        <tbody class="text-gray-700">
                            <tr>
                                <td><input type="text" id="name" name="name" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5"></td>
                                <td><input type="text" id="image" name="image" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5"></td>
                                <td><input type="text" id="base_url" name="base_url" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5"></td>
                                <td><x-button.primary-small type="submit" icon='fa-light fa-square-plus'>Add Social</x-button.primary_small></td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>

        <div class="px-5 text-right">
            <a href="{{ route('settings') }}" class='px-2 py-1 text-sm text-white bg-gray-500 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline'>Back</a>
        </div>

        <script type="module" src="https://unpkg.com/@material-tailwind/html@latest/scripts/tooltip.js"></script>
    </div>
@endsection