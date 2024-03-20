@extends('layouts.app')

@section('content')
<x-site.header>{{ $publisher->name }}</x-site.header>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold text-red-400">Delete Social Media Link</h2>

        <div class="p-3 my-4 text-gray-800 bg-gray-300 rounded-lg">
            Are you sure that you want to delete the <span class="font-bold"><x-site.social-icon>{{ $social->image }}</x-site.social-icon> {{ $social->name }}</span> entry: <span class="font-bold">{{ $social->pivot->url }}</span>?
        </div>

        <div class="w-full mt-6 text-right">
            <x-buttons.dim href="{{ route('publisher.socials', $publisher->id) }}">Cancel</x-buttons.dim>
            <x-buttons.warning href="{{ route('publisher.social_delete_confirm', ['publisher_id' => $publisher->id, 'social_id' => $social->id]) }}" icon="{{ config('ag.icons.delete') }}">Confirm Delete</x-buttons.warning>
        </div>
    </div>
</div> 
@endsection