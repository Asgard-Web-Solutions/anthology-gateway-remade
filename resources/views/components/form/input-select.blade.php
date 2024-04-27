@props(['name', 'selected' => '', 'required' => false, 'description' => '', 'title' => ''])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300">{{ $title }}</label>
    <p class="my-3 text-sm text-gray-500">{{ $description }}</p>
    <select name="{{ $name }}" id="{{ $name }}"
        @if($required) required @endif
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-3/4 m-2 p-2.5
        @error($name) border-red-500 @enderror"
    >
        {{ $slot }}
    </select>    
@error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror   
</div>

