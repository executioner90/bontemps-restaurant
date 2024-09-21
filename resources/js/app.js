import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const message = document.getElementById('message');
    const successMessage = document.getElementById('success');
    const errorMessage = document.getElementById('error');

    axios.post('/api/contact', {
        name: name.value.trim(),
        email: email.value.trim(),
        message: message.value.trim()
    })
        .then(() => {
            successMessage.style.display = 'block'
        })
        .catch(() => {
            errorMessage.style.display = 'block'
        });
});
