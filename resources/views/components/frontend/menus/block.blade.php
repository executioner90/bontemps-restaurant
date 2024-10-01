<div class="mb-2 rounded-lg shadow-lg">
    <a href="{{ route('menus.show', $menu->name) }}">
        <img class="mx-auto max-w-full h-48"
             src="{{ $image }}"
             alt="Image"
        />
        <div class="px-6 py-4">
            <div class="flex mb-2">
                <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">
                    Special menu
                </span>
            </div>

            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                {{ $menu->name }}
            </h4>

            <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
        </div>
        <div class="flex items-center justify-between p-4">
            <span class="text-xl text-green-600">&euro; {{ $menu->price  }}</span>
        </div>
    </a>
</div>
