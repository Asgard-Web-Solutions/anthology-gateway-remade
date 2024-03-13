<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User') }} {{ $user->email }}
    </x-slot>

    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-3xl p-6 mx-auto bg-white rounded-md shadow-sm">
            <h2 class="mb-5 text-2xl font-semibold">Edit Profile</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
    
                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
    
                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- Roles Selection -->
                <div class="mb-6">
                    <span class="block mb-2 text-sm font-medium text-gray-900">Select Roles</span>
                    <div class="flex flex-col space-y-2">
                        @foreach ($roles as $role)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }} class="text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-600"><span class="font-bold">{{ $role->title }}</span> <span class="text-xs font-light text-gray-600">({{ $role->name }})</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <!-- Save Button -->
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save Changes</button>
            </form>
        </div>
    </div>
        
</x-app-layout>