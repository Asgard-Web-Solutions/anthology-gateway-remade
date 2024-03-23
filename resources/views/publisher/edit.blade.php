@extends('layouts.app')

@section('content')
<x-site.header>{{ __('Edit Publisher Info') }} for {{ $publisher->name }}</x-site.header>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Publisher Details</h2>

        <form action="{{ route('publisher.update', $publisher->id) }}" method="POST">
            @csrf
 
            <x-form.input-text name='name' value="{{ $publisher->name }}" required='true'>Name</x-form.input-text>
            <x-form.input-text name='description' value="{{ $publisher->description }}">Description</x-form.input-text>
            <x-form.input-text name='logo_url' value="{{ $publisher->logo_url }}">Logo URL</x-form.input-text>
        
            <div class="flex items-end w-full text-right sm:block">
                <x-button.dim href="{{ route('publisher.view', $publisher->id) }}">Cancel</x-button.dim>
                <x-button.primary type='submit'>Save Publisher Profile</x-button.primary>
            </div>
        </form>
    </div>
</div> 
@endsection