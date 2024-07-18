document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const messagesContainer = document.querySelector('.messages');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');

    // Rating functionality
    stars.forEach(star => {
        star.addEventListener('click', () => {
            stars.forEach(s => s.classList.remove('selected'));
            star.classList.add('selected');
            let prevSibling = star.previousElementSibling;
            while (prevSibling) {
                prevSibling.classList.add('selected');
                prevSibling = prevSibling.previousElementSibling;
            }
        });
    });

    // Chat functionality
    sendButton.addEventListener('click', () => {
        const message = chatInput.value.trim();
        if (message) {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            messagesContainer.appendChild(messageElement);
            chatInput.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });

    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendButton.click();
        }
    });
});
