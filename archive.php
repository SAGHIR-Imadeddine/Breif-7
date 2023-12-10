<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];

    $sql = "UPDATE question SET Archif = 0 WHERE id_question = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $questionId);

    if ($stmt->execute()) {
        echo "Question archive updated successfully.";
        header ("Location: dashboardScrum.php");
    } else {
        echo "Error updating question archive: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>