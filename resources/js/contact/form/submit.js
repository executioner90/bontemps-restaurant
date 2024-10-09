document.getElementById('contactForm').addEventListener('submit', e => {
    e.preventDefault();
    document.getElementById('submit').disabled = true;

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

    setTimeout(function () {
        document.getElementById('submit').disabled = false;
    }, 1000)
});
