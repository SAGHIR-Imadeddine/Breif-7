<?php
// update_question.php

// Include the database connection file
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["qst_id"])) {
    $qst_id = $_POST["qst_id"];

    // Sanitize and retrieve the updated question title and description
    $updated_title = mysqli_real_escape_string($conn, $_POST["updated_title"]);
    $updated_description = mysqli_real_escape_string($conn, $_POST["updated_description"]);

    // Update the question title and description in the 'question' table
    $updateQuestionQuery = "UPDATE question SET tittre = '$updated_title', description = '$updated_description' WHERE id_question = $qst_id";
    $result = mysqli_query($conn, $updateQuestionQuery);

    if (!$result) {
        // Handle the case where the update query fails
        echo "Error updating question details: " . mysqli_error($conn);
        exit;
    }

    // Sanitize and retrieve the updated tags
    $updated_tags = isset($_POST["updated_tags"]) ? $_POST["updated_tags"] : [];

    // Delete existing tags associated with the question
    $deleteTagsQuery = "DELETE FROM tagquestion WHERE question_id = $qst_id";
    $deleteTagsResult = mysqli_query($conn, $deleteTagsQuery);

    if (!$deleteTagsResult) {
        // Handle the case where the delete query fails
        echo "Error deleting existing tags: " . mysqli_error($conn);
        exit;
    }

    // Insert the updated tags into the 'tagquestion' table
    foreach ($updated_tags as $tag_id) {
        $insertTagQuestionQuery = "INSERT INTO tagquestion (tag_id, question_id) VALUES ($tag_id, $qst_id)";
        $insertTagQuestionResult = mysqli_query($conn, $insertTagQuestionQuery);

        if (!$insertTagQuestionResult) {
            // Handle the case where the insert query fails
            echo "Error inserting tags: " . mysqli_error($conn);
            exit;
        }
    }

    // Redirect to the modified question or any other page as needed
    header("Location: dashboardUser.php");
    exit;
} else {
    // Redirect to an error page or handle the invalid request as needed
    echo "Invalid request";
    exit;
}
?>
