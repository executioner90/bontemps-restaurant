document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('date');
    const availableTimesSelect = document.getElementById('time_slot');
    const availableTimeMessage = document.getElementById('availableTimeMessage');

    const fetchAvailableTimes = () => {
        if (!dateInput.value) {
            return;
        }

        axios.get('/admin/api/reservation/available-times', {
            params: {
                date: dateInput.value
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
            .catch(({ response }) => {
                availableTimeMessage.innerHTML = response.data.message || 'Something went wrong getting available times';
            });
    };

    dateInput.addEventListener('change', fetchAvailableTimes);

    if (dateInput.value) {
        fetchAvailableTimes();
    }
});
