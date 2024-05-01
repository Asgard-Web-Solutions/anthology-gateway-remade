@extends('layouts.app')

@section('content')
<div class="block w-full sm:flex">
    <div class="w-full sm:w-1/2">
        <x-site.header><x-site.social-icon>{{ config('ag.icons.author') }}</x-site.social-icon> {{ __('Author Profile') }}</x-site.header>
    </div>

    <div class="w-full my-auto text-right sm:w-1/2">
        @can('update', $author)
            <x-button.primary href="{{ route('author.edit', $author->id) }}" icon="fa-light fa-gear-complex">{{ __('Manage Author Profile') }}</x-button.primary>
        @endcan
    </div>
</div>

<x-content.page>
    <x-content.column size='center'>
        <x-content.box heading="{{ $author->name }}">
            <div class="grid grid-cols-4">
                <div class="col-span-1">
                    <x-site.gravatar size='128' shape='round'>{{ $author->email }}</x-site.gravatar>
                </div>
                <div class="col-span-3">
                    <x-content.section>
                        <x-content.paragraph>{{ $author->biography }}</x-content.paragraph>
                    </x-content.section>
                </div>
                <div class="col-span-4 mt-4">
                    @if ($author->website)
                        <x-site.link style='light' href="{{ $author->website }}">{{ $author->website }}</x-site.link>
                    @endif
                </div>
            </div>

        </x-content.box>
    </x-content.column>
</x-content.page>
@endsection