@extends('layouts.app')

@section('content')
<x-site.header>{{ __('Create Your Author Profile') }}</x-site.header>

<x-content.page>
    <x-content.column size='center'>
        <form action="{{ route('author.store') }}" method="POST">
            @csrf

            <x-content.box heading='Author Profile Details'>
                <x-content.section style='dark'>
                    <x-content.paragraph>Your author profile makes it easy to manage how you appear to the publishers when you submit a manuscript to an anthology project.</x-content.paragraph>
                    <x-content.paragraph>This information will be visible on your author profile page as well as to publishers.</x-content.paragraph>
                </x-content.section>

                <x-content.section>
                    <x-section-form.input-text name='name' required='true'>Author Name</x-section-form.input-text>
                    <x-section-form.input-text-large name='biography' required='true'>Author Bio</x-section-form.input-text-large>
                    <x-section-form.input-text name='website'>Author Website</x-section-form.input-text>
                </x-content.section>        
            </x-content.box>

            <x-content.box heading="Sensitive Profile Details">
                <x-content.section style='dark'>
                    <x-content.paragraph>These are details that may be needed for communication or contracts between you and the publishers.</x-content.paragraph>
                    <x-content.paragraph>This information will only be visible to publishers that you have submitted a manuscript to, and only if the publisher does not decline your submission.</x-content.paragraph>
                </x-content.section>

                <x-content.section>
                    <x-section-form.input-text name="email" value="{{ auth()->user()->email }}" required='true'>Email Address</x-section-form.input-text>
                    <x-section-form.input-text name="address_street_1">Street Address</x-section-form.input-text>
                    <x-section-form.input-text name="address_street_2">Address Line 2</x-section-form.input-text>
                    <x-section-form.input-text name="address_city">City</x-section-form.input-text>
                    <x-section-form.input-text name="address_state">State</x-section-form.input-text>
                    <x-section-form.input-text name="address_country" value="United States of America" required='true'>Country</x-section-form.input-text>
                </x-content.section>
            </x-content.box>

            <x-content.button-section>
                <x-button.dim href="{{ route('dashboard') }}">Cancel</x-button.dim>
                <x-button.primary type='submit'>{{ __('Save Author Profile') }}</x-button.primary>
            </x-content.button-section>
        </form>
    </x-content.column>
</x-content.page>

@endsection