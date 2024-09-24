document.getElementById('contactForm').addEventListener('submit', e => {
    e.preventDefault();

    const { name, email, message } = e.target.elements;
    const [successMessage, errorMessage] = [
        document.getElementById('success'), document.getElementById('error')
    ];

    axios.post('/api/contact', {
        name: name.value.trim(),
        email: email.value.trim(),
        message: message.value.trim()
    })
        .then(() => {
            successMessage.style.display = 'block';
            e.target.reset();
        })
        .catch(() => errorMessage.style.display = 'block');
});
