<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$dbname = "special_access_db";
$dbusername = "root";  // Use a different user in production
$dbpassword = "Nich0las";  // Make sure to set this securely

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed.']));
}

$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

$response = ['success' => false, 'message' => 'Invalid credentials.'];

if ($stmt = $conn->prepare('SELECT password FROM users WHERE username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $response['success'] = true;
            $response['message'] = 'Access granted.';
        }
    }
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>