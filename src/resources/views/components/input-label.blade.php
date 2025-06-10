@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#FEFAE0]']) }}>
    {{ $value ?? $slot }}
</label>
