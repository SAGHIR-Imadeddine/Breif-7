<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $function = mysqli_real_escape_string($conn, $_GET['function']);
    $sql = "UPDATE reponse SET correct = $function WHERE id_reponse = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";

        if ($_SESSION['role'] == "prodOwner") {
            header ("Location: dashboardProd.php");
            exit;
        } else if ($_SESSION['role'] == "scrumMaster") {
            header ("Location: dashboardScrum.php");
            exit;
        } else {
            header ("Location: dashboardUser.php");
            exit;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>