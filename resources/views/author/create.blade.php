@extends('layouts.app')

@section('content')
<x-site.header>{{ __('Create Your Author Profile') }}</x-site.header>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Author Profile Details</h2>

        <div class="p-3 my-4 text-gray-200 bg-gray-500 rounded-lg">
            <p class="my-2">Your author profile makes it easy to manage how you appear to the publishers when you submit a manuscript to an anthology project. This information will be visible on your author profile page as well as to publishers.</p>
        </div>

        <form action="{{ route('author.store') }}" method="POST">
            @csrf
 
            <x-form.input-text name='name' required='true'>Author Name</x-form.input-text>
            <x-form.input-text-large name='biography' required='true'>Author Bio</x-form.input-text-large>
            <x-form.input-text name='website'>Author Website</x-form.input-text>

            <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Author Sensitive Details</h2>
            <div class="p-3 my-4 text-gray-200 bg-gray-500 rounded-lg">
                <p class="my-2">This information will only be visible to publishers that you have submitted a manuscript to.</p>
            </div>

            <x-form.input-text name="email" value="{{ auth()->user()->email }}" required='true'>Email Address</x-form.input-text>
            <x-form.input-text name="address_street_1">Street Address</x-form.input-text>
            <x-form.input-text name="address_street_2">Address Line 2</x-form.input-text>
            <x-form.input-text name="address_city">City</x-form.input-text>
            <x-form.input-text name="address_state">State</x-form.input-text>
            <x-form.input-text name="address_country" value="United States of America" required='true'>Country</x-form.input-text>
        
            <div class="items-end block w-full text-right">
                <x-button.dim href="{{ route('dashboard') }}">Cancel</x-button.dim>
                <x-button.primary type='submit'>{{ __('Save Anthology Project') }}</x-button.primary>
            </div>
        </form>
    </div>
</div> 
@endsection