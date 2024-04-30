@extends('layouts.app')

@section('content')
<x-site.header><x-site.social-icon>{{ config('ag.icons.author') }}</x-site.social-icon> {{ __('Author Profile') }}</x-site.header>

<x-content.page>
    <x-content.column size='center'>
        <x-content.box>

            <x-site.gravatar email='{{ $author->email }}' />

        </x-content.box>
    </x-content.column>
</x-content.page>
@endsection