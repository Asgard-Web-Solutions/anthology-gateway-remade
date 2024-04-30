@extends('layouts.app');

@section('content')
    <x-site.header>{{ __('Editing User') }} {{ $user->email }}</x-site.header>

    <x-content.page>
        <x-content.column size='center'>
            <x-content.box heading='Edit Profile'>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-content.section>
                        <x-section-form.input-text name='name' value='{{ $user->name }}'>Name</x-section-form.input-text>
                        <x-section-form.input-text type='email' name='email' value='{{ $user->email }}'>Email</x-section-form.input-text>
                    </x-content.section>

                    <x-content.section heading='Roles'>
                        <div class="grid grid-cols-1 mb-6 xl:grid-cols-6">
                            <div class="flex items-center h-12 col-span-1 mx-auto my-auto text-center xl:text-left">
                                <label for="roles" class="text-sm font-medium text-gray-900">Select Roles</label>
                            </div>
                            <div class="flex flex-col col-span-1 xl:col-span-5">
                                @foreach ($roles as $role)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" id="roles" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }} class="text-teal-600 border-gray-700 rounded focus:ring-teal-500">
                                        <span class="ml-2 text-sm text-gray-700"><span class="font-bold">{{ $role->title }}</span> <span class="text-xs font-light text-gray-500">({{ $role->name }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>                        
                    </x-content.section>

                    <x-content.button-section>
                        <x-button.dim href="{{ route('users.index') }}">Cancel</x-button.dim>
                        <x-button.primary type='submit'>Save User</x-button.primary>
                    </x-content.button-section>
                </form>
            </x-content.box>
        </x-content.column>
    </x-content.page>

@endsection