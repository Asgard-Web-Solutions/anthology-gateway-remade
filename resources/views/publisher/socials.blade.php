@extends('layouts.app')

@section('content')
<x-site.header>{{ $publisher->name }}</x-site.header>

<div class="block px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto my-3 text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Social Media Settings') }}</h2>
        <div class="p-3 text-gray-800 bg-gray-300 rounded-lg">
            <table class="w-full text-left border-collapse">
                @foreach ($publisher->socials as $social)
                @php
                    $modifiedUrl = str_replace('{id}', $social->pivot->url, $social->base_url);
                @endphp
                <tr>
                    <td><x-site.social-icon>{{ $social->image }}</x-site.social-icon></td>
                    <td><a href="{{ $modifiedUrl }}">{{ $modifiedUrl }}</a></td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>

    <br />

    <div class="max-w-3xl p-6 mx-auto my-3 text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Add Social Media') }}</h2>

        <form action="{{ route('publisher.social_add', $publisher->id) }}" method="POST">
            <table class="w-full text-left border-collapse">
                <!-- Table Header -->
                <thead class="text-white bg-gray-900 rounded-lg">
                    <tr>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b rounded-tl bg-grey-lightest text-grey-dark border-grey-light"><label id='name'>Platform</label></th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light"><label id='image'>URL</label></th>
                        <th class="px-6 py-4 text-sm font-bold uppercase border-b bg-grey-lightest text-grey-dark border-grey-light"><label id='image'>ID</label></th>
                    </tr>
                </thead>
                <!-- Table Body -->
                @csrf
                <tbody class="text-gray-700">
                    <tr>
                        <td>
                            <select name="platform" id="platform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5">
                                <option value="0" data-url="-- Select a Platform --">-- Select a Platform --</option>
                                @foreach ($socials as $social)
                                    <option value="{{ $social->id }}" data-url="{{ $social->base_url }}">{{ $social->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="w-48"><div id="socialURL" class="text-gray-400">-- Select a Platform --</div></td>
                        <td><input type="text" id="url" name="url" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-32 m-2 p-2.5"></td>
                    </tr>
                </tbody>
            </table>
            <br />

            <div class="w-full my-3 text-right">
                <x-buttons.primary type="submit" icon='fa-light fa-square-plus'>Add Social</x-buttons.primary_small>
            </div>
    
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const platformSelect = document.getElementById('platform');
        const socialUrlDisplay = document.getElementById('socialURL');

        platformSelect.addEventListener('change', function () {
            // Get the selected option's value (which should be the social ID)
            const selectedId = this.value;

            // Assuming you have the URLs as data attributes on the options
            const selectedUrl = this.querySelector(`option[value="${selectedId}"]`).dataset.url;

            // Update the display
            socialUrlDisplay.textContent = selectedUrl;
        });
    });
</script>

@endsection