@extends('layouts.app')

@section('content')
    <x-site.header>
        <x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ __('Anthology Browser') }}
    </x-site.header>

    <x-content.page>
        <x-content.column size="full">
            <x-content.box heading='Open Now/Soon'>
                <div class="flex w-full">
                    @forelse ($anthologies as $anthology)
                        <x-content.mini-box heading="{{ $anthology->name }}">
                            <div class="items-center h-96">
                                <a href="{{ route('anthology.view', $anthology->id) }}">
                                    @if ($anthology->cover)
                                        <img src="{{ $anthology->cover }}" class="mx-auto h-96"/>
                                    @else
                                        <img src="{{ $anthology->header }}" />
                                    @endif
                                </a>
                            </div>
                            <div class="h-64 p-2 my-3 border-2 border-collapse border-gray-400 rounded-md">
                                <x-content.paragraph heading="Description">{{ \Illuminate\Support\Str::limit($anthology->description, 250, $end='...') }}</x-content.paragraph>
                            </div>

                            <div class="h-20 p-2 my-3 border-2 border-collapse border-gray-400 rounded-md">
                                <x-content.paragraph heading="Submission Period">
                                    <span class="text-sm">@if ($anthology->open_date) {{ \Carbon\Carbon::parse($anthology->open_date)->format('F j, Y') }} @else TBD @endif</span>
                                     --
                                     <span class="text-sm">@if ($anthology->close_date) {{ \Carbon\Carbon::parse($anthology->close_date)->format('F j, Y') }} @else TBD @endif</span>
                                    </x-content.paragraph>
                            </div>

                            <x-content.button-section>
                                <x-button.primary href="{{ route('anthology.view', $anthology->id) }}">More Info</x-button.primary>
                            </x-content.button-section>

                        </x-content.mini-box>
                    @empty
                        <x-content.section>
                            <x-content.paragraph>There are currently no anthology projects that will be opening soon. Consider starting one?</x-content.paragraph>
                        </x-content.section>
                    @endforelse

                </div>
            </x-content.box>
        </x-content.column>
    </x-content.page>
@endsection