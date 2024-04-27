@extends('layouts.app')

@section('content')
<x-site.header>{{ __('Add Publisher Account') }}</x-site.header>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Publisher Details</h2>

        <form action="{{ route('publisher.store') }}" method="POST">
            @csrf
 
            <x-form.input-text name='name' required='true'>Name</x-form.input-text>
            <x-form.input-text name='description'>Description</x-form.input-text>
            <x-form.input-text name='logo_url'>Logo URL</x-form.input-text>
        
            <div class="items-end block w-full text-right">
                <x-button.dim href="{{ route('dashboard') }}">Cancel</x-button.dim>
                <x-button.primary type='submit'>Save Publisher Profile</x-button.primary>
            </div>
        </form>
    </div>
</div> 
@endsection