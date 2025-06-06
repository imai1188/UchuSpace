@props(['message'])
@if ($message)
    <div class="p-4 m-2 rounded text-[#FF69B4] ">
        {{ $message }}
    </div>
@endif
