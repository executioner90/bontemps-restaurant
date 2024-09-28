<div class="text-center">
    <h3 class="text-2xl font-bold">Our Menu</h3>
    <h2 class="text-3xl font-bold py-3 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
        TODAY'S SPECIALITY</h2>
</div>

<div class="container py-6">
    <div class="grid lg:grid-cols-4 gap-7">
        @foreach($specials as $menu)
            <x-frontend.menus.block :menu="$menu"></x-frontend.menus.block>
        @endforeach
    </div>
</div>
