@extends('layouts.app')

@section('content')
    <x-site.header>
        <x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ __('Anthology Browser') }}
    </x-site.header>

    <x-content.page>
        <x-content.column size="full">
            <x-content.box heading='Open Now/Soon'>
                @foreach ($anthologies as $anthology)
                    <x-content.mini-box heading="{{ $anthology->name }}">
                        <img src="{{ $anthology->cover }}" />
                    </x-content.mini-box>
                @endforeach
            </x-content.box>
        </x-content.column>
    </x-content.page>
@endsection