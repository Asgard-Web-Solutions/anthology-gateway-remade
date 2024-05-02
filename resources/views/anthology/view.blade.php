@extends('layouts.app')

@section('content')
    <div class="block w-full sm:flex">
        <div class="w-full sm:w-1/2">
            <x-site.header><i class="{{ config('ag.icons.anthology') }}"></i> {{ $anthology->name }}</x-site.header>
        </div>

        <div class="w-full my-auto text-right sm:w-1/2 ">
            <x-button.bookmark anthology='{{ $anthology->id }}' bookmarked='{{ $bookmarked }}' @endif/>
            
            @can('update', $anthology)
                <x-button.primary href="{{ route('anthology.manage', $anthology->id) }}" icon="fa-light fa-gear-complex">{{ __('Manage Anthology Settings') }}</x-button.primary>
            @endcan
        </div>
    </div>


    <!-- Main Content Area -->
    <x-content.page>
        
        <x-content.column size='lg'>
            <x-content.box heading='Details'>

                @if ($anthology->header_image)
                    <div class="items-center w-full py-2 mx-auto mb-3 text-center bg-gray-300 rounded-md">
                        <img src="{{ $anthology->header }}" width="720" height="1280" class="mx-auto">
                    </div>
                @endif    

                <x-content.section heading='Description'>
                    <p>
                        {!! nl2br(htmlspecialchars($anthology->description, ENT_QUOTES)) !!}
                    </p>
                </x-content.section>
            </x-content.box>


            <x-content.box heading="Additional Anthology Information">

                <x-content.section heading="Project Status">
                    <x-content.paragraph>
                        {{ ucfirst($anthology->status->value) }}
                    </x-content.paragraph>
                </x-content.section>

                <x-content.section heading="Important Dates">
                    <x-content.paragraph>
                        <table>
                            <tr>
                                <td class="px-3"><span class="font-light text-gray-700">Open for Submissions:</span></td>
                                <td><span class="font-bold"> {{ $anthology->open_date }}</span></td>
                            </tr>
                            <tr>
                                <td class="px-3"><span class="font-light text-gray-700">Submission Deadline:</span></td>
                                <td><span class="font-bold"> {{ $anthology->close_date }}</span></td>
                            </tr>
                            <tr>
                                <td class="px-3"><span class="font-light text-gray-700">Acceptance Deadline:</span></td>
                                <td><span class="font-bold"> {{ $anthology->end_review_date }}</span></td>
                            </tr>
                            <tr>
                                <td class="px-3"><span class="font-light text-gray-700">Planned Publication Date:</span></td>
                                <td><span class="font-bold"> {{ $anthology->est_pub_date }}</span></td>
                            </tr>
                        </table>
                    </x-content.paragraph>
                </x-content.section>

                <x-content.section heading="Distribution Plans">
                    <x-content.paragraph>
                        {{ $anthology->distribution }}
                    </x-content.paragraph>
                </x-content.section>

            </x-content.box>

            <x-content.box heading="Publisher Information">
                @if ($anthology->publisher_id)
                    <x-content.section heading="{{ $anthology->publisher->name }}">
                        <x-content.paragraph>
                            {{ $anthology->publisher->description }}
                        </x-content.paragraph>
                    </x-content.section>
                
                    @foreach ($anthology->publisher->socials as $social)
                        @php
                            $modifiedUrl = str_replace('{id}', $social->pivot->url, $social->base_url);
                        @endphp

                        <span class="mx-1"><a href="{{ $modifiedUrl }}" class="text-purple-300 hover:text-purple-500"><x-site.social-icon>{{ $social->image }}</x-site.social-icon> {{ $social->pivot->url }}</a></span>
                    @endforeach

                    <x-content.button-section>
                        <x-button.primary href="{{ route('publisher.view', $anthology->publisher->id) }}">Publisher Profile</x-button.dim>
                    </x-content.button-section>
                @else
                    <x-content.section>
                        <x-content.paragraph>
                            {{ $anthology->about_publishers }}
                        </x-content.paragraph>
                    </x-content.section>
                @endif
            </x-content.box>


        </x-content.column>

        <x-content.column size='sm'>
            <x-content.box heading="Cover Image">
                <x-content.section>
                    @if ($anthology->cover)
                        <img src="{{ $anthology->cover }}" width="600px">
                    @else
                        Cover Image In Progress...
                    @endif
                </x-content.section>
            </x-content.box>


            <x-content.box heading='Submission Details'>
                <x-content.section heading="Submission Dates">
                    <x-content.paragraph>
                        <span class="font-light text-gray-700">Open for Submissions:</span> <span class="font-bold"> {{ $anthology->open_date }}</span><br />
                        <span class="font-light text-gray-700">Submissions Deadline:</span> <span class="font-bold"> {{ $anthology->close_date }}</span>
                    </x-content.paragraph>
                </x-content.section>

                <x-content.section heading="Submission Length">
                    <x-content.paragraph>
                        {{ number_format($anthology->sub_min_length) }} &mdash; {{ number_format($anthology->sub_max_length) }} Words
                    </x-content.paragraph>
                </x-content.section>

                <x-content.section heading="Submission Guidelines">
                    <x-content.paragraph>
                        {{ $anthology->sub_guidelines }}
                    </x-content.paragraph>
                </x-content.section>

                @if ($anthology->sub_prefer_anon)
                    <x-content.section heading="Anonymous Submission">
                        <x-content.paragraph>
                            <span class="font-bold">Do not include identifying information in your submission manuscript.</span> This means no name or email address in the manuscript.
                        </x-content.paragraph>
                        <br />
                        <x-content.paragraph>
                            <span class="font-light text-gray-800">Don't worry! Anthology Gateway knows who you are and your identity will be shown to the publisher once an unbiased decision has been made on your submission.</span>
                        </x-content.paragraph>
                    </x-content.section>
                @endif

            </x-content.box>
            
            <x-content.box heading='Submission Payment Details'>
                <p>If your submission is accepted, you will be paid:</p>
                
                <x-content.section>
                    <x-content.paragraph>
                        ${{ $anthology->pay_amount }}
                    </x-content.paragraph>
                </x-content.section>

                <x-content.section heading="Additional Payment">
                    <x-content.paragraph>
                        {{ $anthology->pay_supplemental }}
                    </x-content.paragraph>
                </x-content.section>
            </x-content.box>
        </x-content.column>

    </x-content.page>
@endsection