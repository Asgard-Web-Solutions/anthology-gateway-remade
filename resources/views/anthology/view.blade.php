@extends('layouts.app')

@section('content')
    <div class="block w-full sm:flex">
        <div class="w-full sm:w-1/2">
            <x-site.header><i class="{{ config('ag.icons.anthology') }}"></i> {{ $anthology->name }}</x-site.header>
        </div>

        <div class="w-full my-auto text-right sm:w-1/2">
            @can('update', $anthology)
                <x-button.primary href="{{ route('anthology.manage', $anthology->id) }}" icon="fa-light fa-gear-complex">{{ __('Manage Anthology Settings') }}</x-button.primary>
            @endcan
        </div>
    </div>

    @if ($anthology->header_image)
        <div class="block w-full">
            <img src="{{ $anthology->header }}" width="720" height="1280">
        </div>
    @endif

    <!-- Main Content Area -->
    <x-content.page>
        
        <x-content.column size='lg'>
            <x-content.box heading='Details'>
                <x-content.section heading='Description'>
                    <p>
                        {{ $anthology->description }}
                    </p>
                </x-content.section>
            </x-content.box>
        </x-content.column>

        <x-content.column size='sm'>
            <x-content.box heading='More Details...'>
                <x-content.section>
                    TBD
                </x-content.section>
            </x-content.box>

            <x-content.box heading="Cover Image">
                <x-content.section>
                    @if ($anthology->cover)
                        <img src="{{ $anthology->cover }}" width="600px">
                    @else
                        Cover Image In Progress...
                    @endif
                </x-content.section>
            </x-content.box>
        </x-content.column>

    </x-content.page>
@endsection