<?php
include('connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionId = $_POST['questionId'];
    $newTitle = $_POST['title'];
    $newDescription = $_POST['description'];

    // Update the question details in the database
    $updateQuery = "UPDATE question SET tittre = '$newTitle', description = '$newDescription' WHERE id_question = $questionId";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult) {
        // Update successful, you can redirect to the question page or display a success message
        echo "Question updated successfully!";
        header("Location: dashboardUser.php");
    } else {
        // Update failed
        echo "Failed to update question.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}
?>

