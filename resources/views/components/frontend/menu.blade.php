@props(['menus' => null, 'isSpecial' => false])

<div
    x-data="menuSearch({{ $menus ? $menus->toJson() : '[]' }}, {{ $isSpecial ? 'true' : 'false' }})"
    x-init="fetchMenus()"
>
    {{-- Special header for landing page --}}
    <template x-if="isSpecial">
        <div class="text-center">
            <h3 class="text-2xl font-bold">Our Menu</h3>
            <h2 class="text-xl md:text-3xl font-bold py-3 text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                TODAY'S SPECIALITY
            </h2>
        </div>
    </template>

    {{-- Search input (only if not special) --}}
    <template x-if="!isSpecial">
        <div class="w-full search-box my-6">
            <h2 class="text-4xl font-bold text-blue-500 mb-8">Our Menus</h2>

            <input
                x-model.debounce.500ms="search"
                class="w-1/3 border border-gray-300 p-2 rounded"
                type="text"
                placeholder="Search your menu"
            />
        </div>
    </template>

    {{-- Menu grid --}}
    <div class="container py-6">
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-7">
            <template x-for="menu in filteredMenus()" :key="menu.id">
                <div class="mb-2 shadow-lg relative">
                    {{-- Badge --}}
                    <div :class="menu.special ? 'absolute' : 'hidden'">
                        <span class="px-4 py-0.5 text-sm bg-red-500 text-red-50">
                            Special menu
                        </span>
                    </div>

                    {{-- Card Content --}}
                    <a :href="`/menu/${menu.name}`">
                        <img class="mx-auto max-w-full" :src="menu.image" :alt="menu.name + ' image'" />

                        {{-- Text Content --}}
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-sm sm:text-lg text-center font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase"
                                x-text="menu.name"
                            ></h4>
                        </div>
                    </a>
                </div>
            </template>
        </div>

        {{-- Fallback if no menus --}}
        <div class="text-center mt-4" x-show="filteredMenus().length === 0" x-transition>
            <p>No matches found...</p>
        </div>
    </div>
</div>

<script>
    function menuSearch(initialMenus = [], isSpecial = false) {
        return {
            search: '',
            menus: initialMenus,
            isSpecial: isSpecial,

            init() {
                this.$watch('search', () => {
                    this.fetchMenus()
                })
            },

            async fetchMenus() {
                const params = this.isSpecial ? {
                    isSpecial: this.isSpecial,
                } : {
                    search: this.search,
                }

                await axios
                    .get('/api/menu', {params: params})
                    .then((response) => {
                        this.menus = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                        this.menus = [];
                    });
            },

            filteredMenus() {
                let toFilter = this.menus;

                if (this.isSpecial || !this.search) {
                    return this.menus;
                }

                return toFilter.filter(menu => menu.name.toLowerCase().includes(this.search.toLowerCase()));
            }
        }
    }
</script>
