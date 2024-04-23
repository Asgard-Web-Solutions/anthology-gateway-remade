@extends('layouts.app')

@section('content')
<x-site.header><x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ $anthology->name }}</x-site.header>

<x-content.page>

    <x-content.column size='full'>
        <x-content.box heading="{{ ucfirst($setting) }}" size='half'>
            
            <form action="{{ route('anthology.update', $anthology->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @php $valid_setting = true; @endphp
                <input type='hidden' value='{{ $setting }}' name='setting' />

                @switch ($setting)
                    @case ('basic')
                        <x-form.input-text name='name' value='{{ $anthology->name }}'>Anthology Name</x-form.input-text>
                        <x-form.input-text-large name='description' value='{{ $anthology->description }}'>Anthology Name</x-form.input-text-large>
                        <x-form.input-select name='publisher_id' description='Manage all publisher anthology projects in the same place.' title='Publisher'>
                            <option value="0" dsiabled>-- No Publisher --</option>
                            @foreach ($user->publishers as $publisher)
                                <option value="{{ $publisher->id }}" @if ($anthology->publisher_id == $publisher->id) selected @endif>{{ $publisher->name }}</option>
                            @endforeach    
                        </x-form.input-select>
                        <x-form.input-text-large name='about_publishers' value='{{ $anthology->about_publishers }}'>About the Publisher</x-form.input-text-large>
                        <x-form.input-text-large name='distribution' value='{{ $anthology->distribution }}'>Anthology Distribution Plans</x-form.input-text-large>
                    @break

                    @case ('dates')
                        <x-form.date-picker name='open_date' required='true' value="{{ $anthology->open_date }}" description="When will you be open for authors to submit stories?">Open For Submissions Date</x-form.date-picker>
                        <x-form.date-picker name='close_date' required='true' value="{{ $anthology->close_date }}" description="When is the last day authors can submit stories?">Submission Deadline</x-form.date-picker>
                        <x-form.date-picker name='end_review_date' required='true' value="{{ $anthology->end_review_date }}" description="What date do you plan on having a decision to the authors by?">Estimated Decision Date</x-form.date-picker>
                        <x-form.date-picker name='est_pub_date' required='true' value="{{ $anthology->est_pub_date }}" description="What date do you hope to publish the anthology by?">Estimated Publish Date</x-form.date-picker>
                    @break

                    @case ('images')
                        @if ($anthology->header_image)
                            <div class="w-full mx-auto">
                                <img src="{{ $anthology->header }}" class="mx-auto" width="250px">
                            </div>
                        @endif
                        <x-form.input-file name='header_image' accept='image/*' description="An image that will be displayed at the top of your anthology page. 1280x720 for best results">Header Image</x-form.input-text>

                        <br />
                        @if ($anthology->cover_image)
                            <div class="w-full mx-auto">
                                <img src="{{ $anthology->cover }}" class="mx-auto" width="250px">
                            </div>
                        @endif

                        <x-form.input-file name='cover_image' accept='image/*' description="An image that will be displayed as your book cover.">Cover Image</x-form.input-text>
                    @break

                    @case ('submissions')
                        <x-form.input-text-small name='sub_ideal_count' value='{{ $anthology->sub_ideal_count }}' description="Approximately how many submissions do you plan to accept?">Acceptance Count</x-form.input-text>
                        <x-form.input-text-small name='sub_min_length' value='{{ $anthology->sub_min_length }}'>Minimum Submission Length</x-form.input-text>
                        <x-form.input-text-small name='sub_max_length' value='{{ $anthology->sub_max_length }}'>Maximum Submission Length</x-form.input-text>
                        <x-form.input-text-large name='sub_guidelines' value='{{ $anthology->sub_guidelines }}'>Submission Guidelines</x-form.input-text>
                        <x-form.input-checkbox name='sub_prefer_anon' value='{{ $anthology->sub_prefer_anon }}' description="Prefering anonymous submissions means we will instruct the author to not give their name in their submission and Anthology Gateway will hide the authors name until after you vote on the submission.">Prefer Anonymous?</x-form.input-text>
                    @break

                    @case ('messages')
                        <x-form.input-text-large name='msg_accept_text' value='{{ $anthology->msg_accept_text }}' description="What message do you want to send to authors when you accept their submission? {name} and {message} will be substituted at teh time the message is sent.">Acceptance Message</x-form.input-text>
                        <x-form.input-text-large name='msg_decline_text' value='{{ $anthology->msg_decline_text }}' description="What message do you want to send to authors when you Decline their submission? {name} and {message} will be substituted at the time the message is sent.">Decline Message</x-form.input-text>
                    @break

                    @case ('payments')
                        <x-form.input-text-small name='pay_amount' value='{{ $anthology->pay_amount }}' description="How much will the auther be paid if you accept their story?">Author Payment</x-form.input-text>
                        <x-form.input-text-large name='pay_supplemental' value='{{ $anthology->pay_supplemental }}' description="What other ways will you offer to the author?">Supplemental Payment</x-form.input-text>
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