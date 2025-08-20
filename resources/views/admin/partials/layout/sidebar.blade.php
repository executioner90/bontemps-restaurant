<div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800 relative" x-data="{ open: false }">
    @include('admin.partials.layout.sidebar.header')

    <nav
        :class="{'block absolute inset-x-0 top-full z-50 bg-white dark:bg-gray-800 md:relative md:z-auto': open, 'hidden md:block md:relative md:z-auto': !open}"
        class="px-4 pb-4 md:pb-0 md:overflow-visible"
    >
        <x-admin.nav.link :href="route('admin.menu.index')" :active="request()->routeIs('admin.menus.*')">
            {{ __('Menus') }}
        </x-admin.nav.link>

        <x-admin.nav.link :href="route('admin.meal.index')" :active="request()->routeIs('admin.meals.*')">
            {{ __('Meals') }}
        </x-admin.nav.link>

        <x-admin.nav.link :href="route('admin.product.index')" :active="request()->routeIs('admin.products.*')">
            {{ __('Products') }}
        </x-admin.nav.link>

        <x-admin.nav.link :href="route('admin.table.index')" :active="request()->routeIs('admin.tables.*')">
            {{ __('Tables') }}
        </x-admin.nav.link>

        <x-admin.nav.link :href="route('admin.reservation.index')" :active="request()->routeIs('admin.reservations.*')">
            {{ __('Reservations') }}
        </x-admin.nav.link>

        @include('admin.partials.layout.sidebar.user')
    </nav>
</div>
