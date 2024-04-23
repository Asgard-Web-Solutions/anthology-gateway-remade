@extends('layouts.app')

@section('content')
    <x-site.header><x-site.social-icon>{{ config('ag.icons.anthology') }}</x-site.social-icon> {{ $anthology->name }}</x-site.header>
    <!-- Main Content Section -->
    <x-content.page>

        <!-- Left Column -->
        <x-content.column size='lg'>

            <!-- Content Box #1 -->
            <x-content.box heading="Main Dashboard">
                <x-content.section heading="Status">
                    <x-content.paragraph>Status: {{ ucfirst($anthology->status->value) }}</x-content.paragraph>
                    <p class="my-2">
                        Is Public<br />
                        Is Open for Submissions<br />
                        Open Date {{ $anthology->open_date }}<br>
                    </p>
                </x-content.section>

                <x-content.section heading="Settings">
                    <x-table.table>
                        <x-table.head>
                            <x-table.head-row left>Status</x-table.head-row>
                            <x-table.head-row>Step</x-table.head-row>
                            <x-table.head-row right>&nbsp;</x-table.head-row>
                        </x-table.head>
                        <x-table.body>
                            @foreach ($steps as $step)
                                <x-table.row>
                                    <x-table.cell> 
                                        @if (isset($step['status']) && $step['status'] == 1) 
                                            <i class="text-green-600 fa-solid fa-check"></i> 
                                        @else
                                            <i class="text-red-700 fa-solid fa-x"></i>
                                        @endif    
                                    </x-table.cell>
                                    <x-table.cell>{{ $step['name'] }}</x-table.cell>
                                    <x-table.cell><x-button.primary-small href="{{ route('anthology.edit', ['id' => $anthology->id, 'setting' => $step['config']]) }}">Configure</x-button.primary-small></x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.table>
                </x-content.section>

                <x-content.button-section>
                    @if ($anthology->status == App\Enums\AnthologyStatus::Draft)
                        <x-button.primary href="" disabled icon='fa-duotone fa-rocket'>Finish Configuring to Launch</x-button.primary>
                    @elseif ($anthology->status == App\Enums\AnthologyStatus::Prelaunch)
                        <x-button.primary href="{{ route('anthology.launch', $anthology->id) }}" icon='fa-duotone fa-rocket-launch'>Launch</x-button.primary>
                    @endif
                </x-content.button-section>
            </x-content.box>
            
        </x-content.column>

        <!-- Right Column -->
        <x-content.column size='sm'>
            <x-content.box heading="Publisher">
                <x-content.section>
                    @if ($anthology->publisher_id)
                        <x-site.link href="{{ route('publisher.view', $anthology->publisher_id) }}">{{ $anthology->publisher->name }}</x-site.link>
                    @else
                        No Publisher Assigned
                    @endif
                </x-content.section>
            </x-content.box>

            <x-content.box heading="Team">

            </x-content.box>

            <x-content.box heading="Project">
                <x-button.primary href="{{ route('anthology.view', $anthology->id) }}">View Anthology</x-button.primary>
            </x-content.box>
        </x-content.column>
    </x-content.page>

@endsection