@extends('layouts.app')

@section('content')
    <x-site.header>{{ $publisher->name }}</x-site.header>

    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
            <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Edit {{ $social->name }}</h2>
            <form action="{{ route('publisher.social_update', $publisher->id) }}" method="POST">
                @csrf
                <input type="hidden" name="social_id" value="{{ $social->id }}">

                @php
                    $modifiedUrl = str_replace('{id}', $social->pivot->url, $social->base_url);
                @endphp

                <div class="my-4">
                    <span class="mx-3">Base URL: </span>
                    <x-site.social-icon>{{ $social->image }}</x-site.social-icon>
                    <span class="mx-3">{{ $social->base_url }}</span>
                </div>

                <div class="my-4">
                    <span class="mx-3">Your URL: </span>
                    <x-site.social-icon>{{ $social->image }}</x-site.social-icon>
                    <span class="mx-3"><a href="{{ $modifiedUrl }}">{{ $modifiedUrl }}</a></span>
                </div>

                <div class="mx-3 my-4">
                    <x-form.input-text name='url' value='{{ $social->pivot->url }}'>Change your URL Id</x-form.input-text>
                </div>
    
                <!-- Save Button -->
                <div class="flex w-full text-right sm:block ">
                    <x-button.dim href="{{ route('publisher.socials', $publisher->id) }}">Cancel</x-button.dim>
                    <x-button.primary type='submit'>Update Settings</x-button.primary>
                </div>
            </form>
        </div>
    </div> 
@endsection