<?php
include 'db.php'; // Make sure to include your database connection file

function requestStream($userId, $streamId) {
    global $connection;
    $query = "INSERT INTO stream_requests (user_id, stream_id, status) VALUES ($userId, $streamId, 'pending')";
    if (mysqli_query($connection, $query)) {
        echo "Stream requested successfully!";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

function updateViewer($userId, $streamId) {
    global $connection;
    $query = "INSERT INTO active_viewers (user_id, stream_id) VALUES ($userId, $streamId)
              ON DUPLICATE KEY UPDATE last_active = CURRENT_TIMESTAMP";
    mysqli_query($connection, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];
    $streamId = $_POST['stream_id'];
    requestStream($userId, $streamId);
    updateViewer($userId, $streamId);
}
?>
