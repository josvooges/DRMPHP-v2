<?php
include 'db.php'; // Include your database connection

function checkAndStartStream() {
    global $connection;
    $query = "SELECT * FROM stream_requests WHERE status='pending' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $streamId = $row['stream_id'];
        startStream($streamId);
        $updateQuery = "UPDATE stream_requests SET status='active' WHERE id=".$row['id'];
        mysqli_query($connection, $updateQuery);
    }
}

function startStream($streamId) {
    // Add your logic to start the stream here
    // This might involve calling an external service or executing a command
    // For example:
    // shell_exec("start-stream-command --id=$streamId");
}

checkAndStartStream();
?>
