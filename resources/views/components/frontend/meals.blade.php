<div class="grid lg:grid-cols-4 gap-6">
    @foreach($meals as $meal)
        <div class="mb-2 rounded-lg shadow-lg">
            <img class="w-full h-48" src="{{ asset(Storage::url($meal->image)) }}"
                 alt="Menu image"/>
            <div class="px-6 py-4">
                <div class="flex mb-2">
                    <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">Menu</span>
                </div>
                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                    {{ $meal->name }}
                </h4>
                <p class="leading-normal text-gray-700">{{ $meal->description }}.</p>
            </div>
        </div>
    @endforeach
</div>
