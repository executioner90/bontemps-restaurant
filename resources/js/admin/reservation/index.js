import Alpine from 'alpinejs'
Alpine.data('reservationFilter', () => ({
    filters: [
        { label: 'All', value: 'all' },
        { label: 'Old', value: 'old' },
        { label: 'Today', value: 'today' },
        { label: 'Tomorrow', value: 'tomorrow' },
        { label: 'Future', value: 'future' },
    ],
    filter: localStorage.getItem('reservation_view') || 'today',
    search: '',
    reservations: [],
    loading: false,

    async fetchReservations() {
        this.loading = true
        try {
            const params = new URLSearchParams({
                view: this.filter,
                search: this.search,
            });

            const res = await fetch(`/admin/api/reservation?${params.toString()}`);
            this.reservations = await res.json();
        } catch (e) {
            console.error(e)
        } finally {
            this.loading = false
        }
    },

    async setFilter(value) {
        this.filter = value
        localStorage.setItem('reservation_view', value)
        await this.fetchReservations()
    },

    async deleteReservation(id) {
        if (!confirm('Delete this reservation?')) return
        await fetch(`/admin/reservation/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        })
        await this.fetchReservations()
    },
}))
