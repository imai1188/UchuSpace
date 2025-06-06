@props(['value'])

<label {{ $attributes->merge(['class' => 'bg-transparent block font-medium text-sm']) }}>
    {{ $value ?? $slot }}
</label>
