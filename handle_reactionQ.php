<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $questionId = $_POST['questionId'];
    $userId = $_SESSION['id'];

    // Check if the user has already reacted to this question
    $checkQuery = "SELECT * FROM `reaction` WHERE `id_user` = $userId AND `id_question` = $questionId";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult) {
        if ($checkResult->num_rows === 0) {
            // User hasn't reacted, proceed to insert a new reaction
            $reaction = ($action === 'like') ? 1 : 0;

            $insertQuery = "INSERT INTO `reaction` (`reaction`, `id_user`, `id_question`) VALUES ($reaction, $userId, $questionId)";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
                // Insert successful
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit();
            } else {
                // Insert failed
                echo "Failed to insert reaction";
            }
        } else {
            // User has already reacted, proceed to delete the reaction or update it
            $existingReaction = $checkResult->fetch_assoc();
            $existingReactionId = $existingReaction['id_user'];

            if ($existingReaction['reaction'] == ($action === 'like' ? 1 : 0)) {
                // User is clicking the same reaction again, delete the reaction
                $deleteQuery = "DELETE FROM `reaction` WHERE `id_user` = $existingReactionId";
                $deleteResult = $conn->query($deleteQuery);

                if ($deleteResult) {
                    // Deletion successful
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    exit();
                } else {
                    // Deletion failed
                    echo "Failed to delete reaction";
                }
            } else {
                // User is changing the reaction, update the existing record
                $updateQuery = "UPDATE `reaction` SET `reaction` = " . ($action === 'like' ? 1 : 0) . " WHERE `id_user` = $existingReactionId";
                $updateResult = $conn->query($updateQuery);

                if ($updateResult) {
                    // Update successful
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    exit();
                } else {
                    // Update failed
                    echo "Failed to update reaction";
                }
            }
        }
    } else {
        // Database query failed
        echo "Database query failed";
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
?>
