<div class="text-center">
    <h3 class="text-2xl font-bold">Our Menu</h3>
    <h2 class="text-3xl font-bold py-3 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
        TODAY'S SPECIALITY</h2>
</div>

<div class="container py-6">
    <div class="grid lg:grid-cols-4 gap-7">
        @foreach($specials as $menu)
            <div class="mb-2 rounded-lg shadow-lg">
                <a href="{{ route('menus.show', $menu->id) }}">
                    <img class="w-full h-48" src="{{ asset(Storage::url($menu->image)) }}"
                         alt="Image"/>
                    <div class="px-6 py-4">
                        <div class="flex mb-2">
                                    <span
                                        class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Special menu</span>
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
        @endforeach
    </div>
</div>
