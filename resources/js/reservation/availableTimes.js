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
                    availableTimeMessage.classList.remove('hidden')

                    return;
                }

                // Clear previous options
                availableTimesSelect.innerHTML = '';
                availableTimeMessage.classList.add('hidden')

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select time';
                defaultOption.disabled = true;
                defaultOption.selected = true;
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
            });
    };

    totalGuestsInput.addEventListener('keyup', fetchAvailableTimes);
    dateInput.addEventListener('change', fetchAvailableTimes);
});