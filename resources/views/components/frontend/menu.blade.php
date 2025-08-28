@props([
    'items' => null,
    'menuSlug' => null,
    'isSpecial' => false,
])

<div
    x-data="itemSearch({{ $items ? $items->toJson() : '[]' }}, {{ $isSpecial ? 'true' : 'false' }}, '{{ $menuSlug }}')"
    x-init="fetchItems()"
>
    {{-- Special menu's header for landing page --}}
    <template x-if="isSpecial">
        <div class="text-center">
            <h3 class="text-2xl font-bold">Our Menus</h3>
            <h2 class="text-xl md:text-3xl font-bold py-3 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                TODAY'S SPECIALITY
            </h2>
        </div>
    </template>

    {{-- Search input (only if not special) --}}
    <template x-if="!isSpecial">
        <div class="w-full search-box my-6">
            <h2 class="text-4xl font-bold text-blue-500 mb-8">Our {{ Str::ucfirst($menuSlug) ?: 'Menus' }}</h2>

            <input
                x-model.debounce.500ms="search"
                class="w-1/3 border border-gray-300 p-2 rounded"
                type="text"
                placeholder="Search..."
            />
        </div>
    </template>

    {{-- Item grid --}}
    <div class="container py-6">
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-7">
            <template x-for="item in filteredItems()" :key="item.id">
                <div class="mb-2 shadow-lg relative">
                    {{-- Badge --}}
                    <div :class="item.special ? 'absolute' : 'hidden'">
                        <span class="px-4 py-0.5 text-sm bg-red-500 text-red-50">
                            Special
                        </span>
                    </div>

                    {{-- Card Content --}}
                    @if(!$menuSlug)
                        <a :href="`/menu/${item.slug}`">
                            <img class="mx-auto max-w-full" :src="item.image" :alt="`${item.name} image`" />

                            {{-- Text Content --}}
                            <div class="px-6 py-4">
                                <h4 class="mb-3 text-sm sm:text-lg text-center font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase"
                                    x-text="item.name"
                                ></h4>
                            </div>
                        </a>
                    @else
                        <div class="cursor-pointer" @click="$dispatch('open-item-modal', item)">
                            <img class="mx-auto max-w-full" :src="item.image" :alt="item.name + ' image'" />

                            {{-- Text Content --}}
                            <div class="px-6 py-4">
                                <h4 class="mb-3 text-sm sm:text-lg text-center font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase"
                                    x-text="item.name"
                                ></h4>
                            </div>
                        </div>
                    @endif
                </div>
            </template>
        </div>

        {{-- Fallback if no items --}}
        <div class="text-center mt-4" x-show="filteredItems().length === 0" x-transition>
            <p>No matches found...</p>
        </div>
    </div>
</div>

<div
    x-data="mealModal()"
    x-show="isOpen"
    x-on:open-item-modal.window="openModal($event.detail)"
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
    class="fixed inset-0 z-10 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
            {{-- Content --}}
            <div class="text-center">
                <h3 class="text-lg font-medium leading-6 text-gray-800" x-text="currentMeal.name"></h3>
                <p class="mt-2 text-sm text-gray-500" x-text="currentMeal.description"></p>
            </div>

            <div class="mt-5 sm:flex sm:justify-end">
                <button @click="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 border rounded-md hover:bg-gray-100 focus:outline-none focus:ring">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function itemSearch(initialItems = [], isSpecial = false, menuSlug = null) {
        return {
            search: '',
            items: initialItems,
            isSpecial: isSpecial,
            menuSlug: menuSlug,

            init() {
                this.$watch('search', () => {
                    this.fetchItems()
                })
            },

            async fetchItems() {
                const params = this.isSpecial ? {
                    isSpecial: this.isSpecial,
                } : {
                    search: this.search,
                }

                const apiEndpoint = !this.menuSlug ? '/api/menu' : `/api/menu/${this.menuSlug}`;

                await axios
                    .get(apiEndpoint, { params: params })
                    .then((response) => {
                        this.items = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.items = [];
                    });
            },

            filteredItems() {
                let toFilter = this.items;

                if (this.isSpecial || !this.search) {
                    return this.items;
                }

                return toFilter.filter(item => item.name.toLowerCase().includes(this.search.toLowerCase()));
            }
        }
    }

    function mealModal() {
        return {
            isOpen: false,
            currentMeal: {},
            openModal(item) {
                this.currentMeal = item;
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;

                setTimeout(() => {
                    this.currentMeal = {};
                }, 500);
            }
        }
    }
</script>
