<?php
require_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['qst_id'])) {

    $qstId = $_GET['qst_id'];
    echo" $qstId";

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

try {
    // Assuming $qstId is the ID you want to delete.
     // Replace with your actual ID.

    $stmt = mysqli_prepare($conn, "DELETE FROM question WHERE id_question = ?");
    mysqli_stmt_bind_param($stmt, "i", $qstId);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    $affectedRows = mysqli_stmt_affected_rows($stmt);

    if ($affectedRows > 0) {
        echo "Record deleted successfully";
    } else {
        echo "No records deleted";
    }

    mysqli_stmt_close($stmt);

    // Redirect to dashboardUser.php after deletion
    header("Location: dashboardUser.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}


// Close the connection
mysqli_close($conn);}
?>
