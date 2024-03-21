@extends('layouts.app')

@section('content')
<x-site.header>{{ $publisher->name }}</x-site.header>

<div class="block px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto my-3 text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Social Media Settings') }}</h2>
        <div class="p-3 text-gray-800 bg-gray-200 rounded-lg">
            
            <div class="w-full text-sm text-left sm:text-base">
                @foreach ($publisher->socials as $social)
                    @php
                        $modifiedUrl = str_replace('{id}', $social->pivot->url, $social->base_url);
                    @endphp
                    
                    <div class="block sm:flex">
                        <div class="w-full mb-2 sm:mb-2 sm:w-3/4"><x-site.social-icon>{{ $social->image }}</x-site.social-icon> <a href="{{ $modifiedUrl }}">{{ $modifiedUrl }}</a></div>
                        <div class="w-full mb-5 sm:w-1/4 sm:mb-2">
                            <x-buttons.primary-small href="{{ route('publisher.social_edit', ['publisher_id' => $publisher->id, 'social_id' => $social->id]) }}" icon="{{ config('ag.icons.edit') }}">Edit</x-buttons.primary-small>
                            <x-buttons.warning-small href="{{ route('publisher.social_delete', ['publisher_id' => $publisher->id, 'social_id' => $social->id]) }}" icon="{{ config('ag.icons.delete') }}">Delete</x-buttons.warning-small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <br />

    <div class="max-w-3xl p-6 mx-auto my-3 text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">{{ __('Add Social Media') }}</h2>

        <form action="{{ route('publisher.social_add', $publisher->id) }}" method="POST">
            @csrf

            <div class="block sm:flex">
                <div class="w-full my-6 sm:w-1/2">
                    <label id="platform" class="font-bold text-gray-200">Platform</label>
                    <select name="platform" id="platform" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5">
                        <option value="0" data-url="-- Select a Platform --">-- Select a Platform --</option>
                        @foreach ($socials as $social)
                            <option value="{{ $social->id }}" data-url="{{ $social->base_url }}">{{ $social->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full my-6 sm:w-1/2">
                    <label id='image' class="font-bold text-gray-200">URL Id</label>
                    <span id="socialURL" class="mx-4 text-gray-400">-- Select a Platform --</span>
                    <x-form.input-text name="url" required=true placeholder="{id}"></x-form.input-text>
                </div>
            </div>

            <div class="w-full mt-6 mb-3 text-right">
                <x-buttons.primary type="submit" icon='fa-light fa-square-plus'>Add Social</x-buttons.primary_small>
            </div>
    
        </form>
    </div>

    <div class="w-full text-right">
        <x-buttons.dim href="{{ route('publisher.view', $publisher->id) }}">Back</x-buttons.dim>
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