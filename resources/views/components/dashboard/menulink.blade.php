@props(['path', 'title'])

@php
    $isActive = request()->is(trim($path, '/'));
@endphp

<li>
    <a href="{{ $path }}" 
        class="flex items-center p-2 rounded-lg 
            {{ $isActive ? 'bg-linen text-slate-900' : 'hover:bg-linen hover:text-slate-950' }} 
            group">
        {{ $slot }}
        <span class="ms-3 text-lg text-slate-950 group-hover:text-yellow-700">{{ $title }}</span>
    </a>
</li>
