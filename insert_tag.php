
<?php
include 'connection.php';
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit; 
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tagName"])) {
    $tagName = $_POST["tagName"];
   
   
    // Insert the tag into the 'tags' table
    $insertTagQuery = "INSERT INTO tag (tag_name) VALUES ('$tagName')";
    $result = mysqli_query($conn, $insertTagQuery);

    if ($result) {
        // Get the ID of the inserted tag
        
        dd($tagID);

        // Return success and the tag ID
        echo json_encode(["success" => true, "tagID" => "$tagID"]);
    } else {
        // Return an error message
        echo json_encode(["success" => false, "message" => "Error inserting tag"]);
    }
} else {
    // Return an error message if the request is invalid
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>

