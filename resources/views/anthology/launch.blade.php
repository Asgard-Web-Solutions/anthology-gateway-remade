@extends('layouts.app')

@section('content')
    <x-site.header><x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ $anthology->name }}</x-site.header>
    
    <!-- Main Content Section -->
    <x-content.page>

        <!-- Left Column -->
        <x-content.column size='full'>

            <x-content.box heading="Launch" size='half'>
                <x-content.section heading="Are you ready to launch?">
                    <x-content.paragraph>Launch your anthology to make it public. This will allow authors to see your anthology project details, favorite it, and follow its progress.</x-content.paragraph>
                    <x-content.paragraph>When your <span class="font-bold">Open Submission Date</span> arrives authors will be notified and will be able to submit their stories.</x-content.paragraph>
                    <x-content.paragraph>Don't worry if something isn't perfect. You will be able to update your anthology project settings after it has been launched.</x-content.paragraph>
                </x-content.section>

                <x-content.button-section>
                    <x-button.dim href=" {{ route('anthology.manage', $anthology->id) }}">Cancel</x-button.dim>
                    <x-button.primary href="{{ route('anthology.launch_confirm', $anthology->id) }}" icon="fa-duotone fa-rocket-launch">Launch!</x-button.primary>
                </x-content.button-section>

            </x-content.box>

        </x-content.column>

    </x-content.page>

@endsection