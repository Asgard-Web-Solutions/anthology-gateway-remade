@extends('layouts.app')

@section('content')
<x-site.header><x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ $anthology->name }}</x-site.header>

<x-content.page>

    <x-content.column size='full'>
        <x-content.box heading="{{ ucfirst($setting) }}" size='half'>
            
            <form action="{{ route('anthology.update', $anthology->id) }}" method="POST">
                @csrf

                @switch ($setting)
                    @case ('details')
                        <x-form.input-text name='name' value='{{ $anthology->name }}'>Anthology Name</x-form.input-text>
                        <x-form.input-text name='description' value='{{ $anthology->description }}'>Anthology Name</x-form.input-text>
                    @break

                    @default
                        <x-content.section heading="Invalid Setting">
                            Invalid selection
                        </x-content.section>
                @endswitch

                <x-content.button-section>
                    <x-button.primary type='submit'>Update Settings</x-buttons.primary>
                </x-content.button-section>
            </form>

        </x-content.box>
    </x-content.column>
</x-content.page>

<div class="container px-4 py-8 mx-auto">
    <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
        <h2 class="mb-5 text-2xl font-semibold" style="color: #25e4e1">Anthology Details</h2>

        <div class="p-3 my-4 text-gray-800 bg-gray-200 rounded-lg">
            <p class="my-2">Give us the basics of your anthology. Don't worry if you don't have it all figured out at the moment. All of this information can be changed later before your project is searchable on Anthology Gateway.</p>
        </div>

        <form action="{{ route('anthology.store') }}" method="POST">
            @csrf
 
            <x-form.input-text name='name' required='true'>Name</x-form.input-text>
            <x-form.input-text name='description' required='true'>Description</x-form.input-text>
            <x-form.date-picker name='open_date' required='true'>Open For Submissions Date</x-form.date-picker>
        
            <div class="items-end block w-full text-right">
                <x-button.dim href="{{ route('dashboard') }}">Cancel</x-button.dim>
                <x-button.primary type='submit'>{{ __('Save Anthology Project') }}</x-button.primary>
            </div>
        </form>
    </div>
</div> 
@endsection