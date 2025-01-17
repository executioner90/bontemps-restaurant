<div class="mb-2 shadow-lg relative">
    <!-- Badge -->
    <div class="absolute">
        <span class="px-4 py-0.5 text-sm bg-red-500 text-red-50">
            Special menu
        </span>
    </div>

    <!-- Card Content -->
    <a href="{{ route('menus.show', $menu->name) }}">
        <img class="mx-auto max-w-full"
             src="{{ $menu->image }}"
             alt="{{ $menu->name . ' image' }}"
        />

        <!-- Text Content -->
        <div class="px-6 py-4">
            <h4 class="mb-3 text-sm sm:text-lg text-center font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                {{ $menu->name }}
            </h4>
        </div>
    </a>
</div>
