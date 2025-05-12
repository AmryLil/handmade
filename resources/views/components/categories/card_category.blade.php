<div
    class="cursor-pointer hover:bg-slate-900 hover:text-slate-50 duration-500 text-gray-800 transition-all group relative bg-white shadow-md rounded-lg overflow-hidden w-full">
    <a href="{{ $path }}">
        <img src="{{ $image }}" alt="Cleanser" loading="lazy"
            class="w-full h-56 object-cover transition-transform duration-500 transform group-hover:scale-105">
        <div class="p-4 px-6">
            <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
            <p class="">{{ $desc }}</p>
        </div>
    </a>
</div>
