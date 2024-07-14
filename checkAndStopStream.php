<?php
include 'db.php'; // Include your database connection

function checkAndStopStream() {
    global $connection;
    $timeout = 300; // Timeout in seconds (e.g., 300 seconds = 5 minutes)
    $query = "SELECT stream_id FROM active_viewers GROUP BY stream_id HAVING MAX(last_active) < (NOW() - INTERVAL $timeout SECOND)";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $streamId = $row['stream_id'];
        stopStream($streamId);
    }
    // Remove inactive viewers
    $cleanupQuery = "DELETE FROM active_viewers WHERE last_active < (NOW() - INTERVAL $timeout SECOND)";
    mysqli_query($connection, $cleanupQuery);
}

function stopStream($streamId) {
    // Add your logic to stop the stream here
    // This might involve calling an external service or executing a command
    // For example:
    // shell_exec("stop-stream-command --id=$streamId");
}

checkAndStopStream();
?>
