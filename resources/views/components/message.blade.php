@props(['message'])
@if ($message)
    <div class="p-4 m-2 rounded bg-yellow-200">
        {{ $message }}
    </div>
@endif
