<div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800" x-data="{ open: false }">
    <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
        <a href="{{ route('admin.index') }}" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">Dashboard</a>
        <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
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

        <div @click.away="open = false" class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>{{ Auth::user()->name }}</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>

            <div x-show="open" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                        <a class="block w-full px-4 py-2 text-left text-sm leading-5 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"
                           href="{{ Auth::user()->role_id === 1 ? route('admin.user.index') : route('admin.user.edit', ['id' => Auth::user()->id]) }}">
                            Users
                        </a>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                        <x-admin.nav.dropdown.link :href="route('admin.logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                         class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            {{ __('Log Out') }}
                        </x-admin.nav.dropdown.link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
