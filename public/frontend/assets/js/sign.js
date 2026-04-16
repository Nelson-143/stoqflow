function showWelcome() {
    const username = document.getElementById('username').value;
    const businessName = document.getElementById('businessname').value;

    // Display the first message
    const message1 = document.getElementById('message1');
    message1.innerHTML = `<p>Hi, ${username}! Welcome to Roman Stock Manager.</p>`;
    message1.style.display = 'block';

    // Hide the first message and show the second after 3 seconds
    setTimeout(() => {
        message1.style.display = 'none';
        const message2 = document.getElementById('message2');
        message2.innerHTML = `<p>Roman is now creating a new environment for ${businessName}.</p>`;
        message2.style.display = 'block';

        // Hide the second message and show the third after 3 seconds
        setTimeout(() => {
            message2.style.display = 'none';
            const message3 = document.getElementById('message3');
            message3.innerHTML = `<p>Welcome on board, champion!</p>`;
            message3.style.display = 'block';

            // Hide the third message after 3 seconds
            setTimeout(() => {
                message3.style.display = 'none';
                // Optionally, you can redirect or show the main application content here
                // window.location.href = 'nextpage.html';
            }, 3000); // Adjust timing as needed
        }, 3000); // Adjust timing as needed
    }, 3000); // Adjust timing as needed
}
