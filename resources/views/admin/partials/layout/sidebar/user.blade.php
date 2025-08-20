<div @click.away="open = false" class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
        <span>{{ Auth::user()->name }}</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>

    <div x-show="open" class="absolute right-0 mt-2 origin-top-right rounded-md shadow-lg w-full">
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
