document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevents page refresh

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;

    console.log('Name:', name);
    console.log('Email:', email);
    console.log('Message:', message);

    alert('Thank you for your message!');
});

document.getElementById('special-access-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    if (username && password) {
      fetch('server/special-access.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username: username, password: password })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          document.getElementById('special-content').style.display = 'block';
        } else {
          alert(data.message);
        }
      })
      .catch(error => console.error('Error:', error));
    }
  });
  