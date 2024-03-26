@props(['name', 'value' => '', 'required' => false, 'placeholder' => 'Select Date', 'description' => ''])

<div class="mb-6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300">{{ $slot }}</label>
    @if ($description)
        <p class="my-3 text-sm text-gray-500">{{ $description }}</p>
    @endif
    <input type="text" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        value="{{ old($name, $value) }}"
        class="block mt-2 mb-2 text-sm font-medium text-gray-900 rounded-md form-control flatpickr" 
        placeholder="{{ $placeholder ?? 'Select Date...' }}"
        @if ($required) required @endif
    >
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".flatpickr", {});
        });
    </script>
@endpush
