@extends('layouts.app')

@section('content')
<x-site.header><x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ $anthology->name }}</x-site.header>

<x-content.page>

    <x-content.column size='full'>
        <x-content.box heading="{{ ucfirst($setting) }}" size='half'>
            
            <form action="{{ route('anthology.update', $anthology->id) }}" method="POST">
                @csrf
                @php $valid_setting = true; @endphp
                <input type='hidden' value='{{ $setting }}' name='setting' />

                @switch ($setting)
                    @case ('basic')
                        <x-form.input-text name='name' value='{{ $anthology->name }}'>Anthology Name</x-form.input-text>
                        <x-form.input-text name='description' value='{{ $anthology->description }}'>Anthology Name</x-form.input-text>
                        <x-form.input-text name='about_publishers' value='{{ $anthology->about_publishers }}'>About the Publisher</x-form.input-text>
                        <x-form.input-text name='distribution' value='{{ $anthology->distribution }}'>Anthology Distribution Plans</x-form.input-text>
                    @break

                    @case ('dates')
                        <x-form.date-picker name='open_date' required='true' value="{{ $anthology->open_date }}" description="When will you be open for authors to submit stories?">Open For Submissions Date</x-form.date-picker>
                        <x-form.date-picker name='close_date' required='true' value="{{ $anthology->close_date }}" description="When is the last day authors can submit stories?">Submission Deadline</x-form.date-picker>
                        <x-form.date-picker name='end_review_date' required='true' value="{{ $anthology->end_review_date }}" description="What date do you plan on having a decision to the authors by?">Estimated Decision Date</x-form.date-picker>
                        <x-form.date-picker name='est_pub_date' required='true' value="{{ $anthology->est_pub_date }}" description="What date do you hope to publish the anthology by?">Estimated Publish Date</x-form.date-picker>
                    @break

                    @case ('submissions')
                        <x-form.input-text-small name='sub_ideal_count' value='{{ $anthology->sub_ideal_count }}' description="Approximately how many submissions do you plan to accept?">Acceptance Count</x-form.input-text>
                        <x-form.input-text name='sub_guidelines' value='{{ $anthology->sub_guidelines }}'>Submission Guidelines</x-form.input-text>
                        <x-form.input-text-small name='sub_min_length' value='{{ $anthology->sub_min_length }}'>Minimum Submission Length</x-form.input-text>
                        <x-form.input-text-small name='sub_max_length' value='{{ $anthology->sub_max_length }}'>Maximum Submission Length</x-form.input-text>
                        <x-form.input-text name='sub_prefer_anon' value='{{ $anthology->sub_prefer_anon }}' description="Prefering anonymous submissions means we will instruct the author to not give their name in their submission and Anthology Gateway will hide the authors name until after you vote on the submission.">Prefer Anonymous?</x-form.input-text>
                    @break

                    @default
                        <x-content.section heading="Invalid Setting">
                            Invalid selection
                        </x-content.section>
                        @php $valid_setting = false; @endphp
                @endswitch

                <x-content.button-section>
                    <x-button.dim href="{{ route('anthology.manage', $anthology->id ) }}">Cancel</x-button.dim>
                    @if ($valid_setting)
                        <x-button.primary type='submit'>Update Settings</x-buttons.primary>
                    @endif
                </x-content.button-section>
            </form>

        </x-content.box>
    </x-content.column>
</x-content.page>

@endsection