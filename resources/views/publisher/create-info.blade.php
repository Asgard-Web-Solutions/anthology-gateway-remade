@extends('layouts.app')

@section('content')
<x-site.header>{{ __('Add Publisher Account') }}</x-site.header>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Publisher Account Info</h2>

        <div class="w-full p-2 text-gray-800 rounded-lg bg-gray-50">
            <p class="m-2">
                Add your publishing company profile to Anthology Gateway!
            </p>
            <p class="m-2">
                This will allow you to create each Anthology project under a single publisher, manage your team across all of the projects, and allow authors to see your history of other anthologies.
            </p>
        </div>

        <div class="w-full mt-4 text-right">
            <x-button.dim href="{{ route('dashboard') }}">Cancel</x-button.dim>
            <x-button.primary icon='fa-duotone fa-memo-pad' href="{{ route('publisher.create-detail') }}">Create Publisher Profile</x-button.primary-small>
        </div>
    </div>
</div> 
@endsection