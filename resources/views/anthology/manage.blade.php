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
                                    <x-table.cell><x-button.primary-small href="{{ route('anthology.edit', ['id' => $anthology->id, 'setting' => $step['config']]) }}">Change</x-button.primary-small></x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-table.body>
                    </x-table.table>
                </x-content.section>
            </x-content.box>
            
        </x-content.column>

        <!-- Right Column -->
        <x-content.column size='sm'>
            <x-content.box heading="Team">

            </x-content.box>
        </x-content.column>
    </x-content.page>

@endsection