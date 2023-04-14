<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['message'])) {
    $username = $data['username'];
    $message = $data['message'];

    $pdo = new PDO('mysql:host=localhost;dbname=chat_db', 'root', 'password');

    $stmt = $pdo->prepare('INSERT INTO messages (username, message) VALUES (:username, :message)');
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    $response = [
        'success' => true,
        'message' => 'Message created successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Username and message are required'
    ];
}

echo json_encode($response);
