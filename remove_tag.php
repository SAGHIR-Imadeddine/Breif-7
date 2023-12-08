
<?php
// Assume you have a database connection established here
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tagID"])) {
    $tagID = $_POST["tagID"];

    // Delete the tag from the 'tags' table
    $deleteTagQuery = "DELETE FROM tag WHERE id_tag = $tagID";
    $result = mysqli_query($conn, $deleteTagQuery);

    if ($result) {
        // Return success
        echo json_encode(["success" => true]);
    } else {
        // Return an error message
        echo json_encode(["success" => false, "message" => "Error removing tag"]);
    }
} else {
    // Return an error message if the request is invalid
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>

