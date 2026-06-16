@props([
    'name' => 'required',
])

<p class="text-red-600 text-sm mt-1">
    @error($name)
        {{ $message }}
    @enderror
</p>
