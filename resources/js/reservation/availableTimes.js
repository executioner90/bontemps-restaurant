document.addEventListener('DOMContentLoaded', function () {
    const totalGuestsInput = document.getElementById('total_guests');
    const dateInput = document.getElementById('date');
    const availableTimesSelect = document.getElementById('time_slot');
    const availableTimeMessage = document.getElementById('availableTimeMessage');

    const fetchAvailableTimes = () => {
        if (!totalGuestsInput.value || !dateInput.value) {
            return;
        }

        axios.get('/api/reservation/available-times', {
            params: {
                date: dateInput.value,
                totalGuests: totalGuestsInput.value
            }
        })
            .then(({ data }) => {
                if (data.length === 0) {
                    availableTimeMessage.innerHTML = 'No available time for selected date and total guests.';

                    return;
                }

                // Clear previous options
                availableTimesSelect.innerHTML = '';
                availableTimeMessage.innerHTML= '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select time';
                defaultOption.disabled = true;
                availableTimesSelect.appendChild(defaultOption);

                // Populate available times
                data.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time.id;
                    option.textContent = time.label;
                    availableTimesSelect.appendChild(option);
                });

                availableTimesSelect.disabled = false;
            })
            .catch(({ error }) => {
                console.error("Error fetching available times: ", error);

                availableTimeMessage.innerHTML = 'Something went wrong getting available times';
            });
    };

    totalGuestsInput.addEventListener('keyup', fetchAvailableTimes);
    dateInput.addEventListener('change', fetchAvailableTimes);

    if (totalGuestsInput.value && dateInput.value) {
        fetchAvailableTimes();
    }
});
