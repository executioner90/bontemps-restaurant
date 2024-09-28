<div class="grid lg:grid-cols-4 gap-6">
    @foreach($menus as $menu)
        <x-frontend.menus.block :menu="$menu"></x-frontend.menus.block>
    @endforeach
</div>
