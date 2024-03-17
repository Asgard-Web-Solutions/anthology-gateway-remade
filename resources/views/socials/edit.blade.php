@extends('layouts.app')

@section('content')
    <x-site.header>{{ __('Editing Social Media Site ') }} {{ $social->name }}</x-site.header>

    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl p-6 mx-auto text-gray-300 bg-gray-900 rounded-md shadow-sm">
            <h2 class="mb-5 text-2xl font-semibold">Edit Details</h2>
            <form action="{{ route('socials.update', $social->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
                    <input type="text" id="name" name="name" value="{{ $social->name }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                </div>
    
                <!-- Icon Field -->
                <div class="mb-6">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Icons</label>
                    <input type="text" id="image" name="image" value="{{ $social->image }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                </div>

                <!-- Base URL Field -->
                <div class="mb-6">
                    <label for="base_url" class="block mb-2 text-sm font-medium text-gray-300">Base URL</label>
                    <input type="text" id="base_url" name="base_url" value="{{ $social->base_url }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                </div>
            
                <!-- Save Button -->
                <div class="flex w-full">
                    <div class="w-1/2 text-left">
                        <button type="submit" class="text-white bg-purple-800 hover:bg-purple-950 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save Changes</button>
                    </div>
                    <div class="w-1/2 p-2 text-right">
                        <a href="{{ route('socials') }}" class="text-white bg-gray-800 hover:bg-gray-950 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div> 
@endsection