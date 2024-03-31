@extends('layouts.app')    

@section('content')
    <x-site.header>{{ __('Admin Control Panel') }}</x-site.header>

    <div class="flex w-full">
        @can('viewAny', App\Models\Social::class)
            <div class="flex">
                <div class="block p-2 mx-2 text-gray-200 bg-gray-900 rounded-md">
                    <h2 class="mx-2" style="color: #25e4e1">Site Settings</h2>

                    <a href="{{ route('socials') }}">
                        <div class="w-48 p-2 m-2 text-black bg-gray-200 rounded-md hover:bg-gray-300">
                            <h2 class="font-bold text-red-900"><i class="fa-duotone fa-comments"></i> Social Media Sites</h2>
                            <p class="m-2 text-sm font-light">
                                Total: <span class="font-bold">{{ $socialsCount }}</span>
                            </p>
                        </div>
                    </a>
                    
                </div>
            </div>
        @endcan

        @can('viewAny', App\Models\User::class)
            <div class="flex">
                <div class="p-2 mx-2 bg-gray-900 rounded-md">
                    <h2 class="mx-2" style="color: #25e4e1">Gatekeeper</h2>
                    <livewire:dashboardPanels.UsersPanel />            
                </div>
            </div>
        @endcan

        @can('viewAny', App\Models\Publisher::class)
            <div class="flex">
                <div class="p-2 mx-2 bg-gray-900 rounded-md">
                    <h2 class="mx-2" style="color: #25e4e1">Sentinels</h2>

                    <div class="flex w-full">
                        <a href="{{ route('publishers') }}">
                            <div class="w-48 p-2 m-2 text-black bg-gray-200 rounded-md hover:bg-gray-300">
                                <h2 class="font-bold text-red-900"><i class="fa-duotone fa-comments"></i> Publishers</h2>
                                <p class="m-2 text-sm font-light">
                                    New: <span class="mr-4 font-bold">{{ $publisherInfo['new'] }}</span>
                                    Total: <span class="font-bold">{{ $publisherInfo['total'] }}</span>
                                </p>
                            </div>
                        </a>

                        <a href="{{ route('anthologies') }}">
                            <div class="w-48 p-2 m-2 text-black bg-gray-200 rounded-md hover:bg-gray-300">
                                <h2 class="font-bold text-red-900"><i class="fa-duotone fa-comments"></i> Anthologies</h2>
                                <p class="m-2 text-sm font-light">
                                    New: <span class="mr-4 font-bold">{{ $anthologyInfo['new'] }}</span>
                                    Total: <span class="font-bold">{{ $anthologyInfo['total'] }}</span>
                                </p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        @endcan
    </div>

@endsection