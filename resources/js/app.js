import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'pusher',
    key: '01631be2f4a8bc696151',
    cluster: 'eu',
    forceTLS: true
});

echo.channel('chat.' + receiverId)
    .listen('MessageSent', (event) => {
        console.log(event.message);
        // Обновите UI с новым сообщением
    });

document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/chat/send', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Обновить UI после отправки сообщения
        });
});

