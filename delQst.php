<?php
require_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_question'])) {
    
    $qstId = $_GET['id_question'];

    try {
        
        $stmt = $conn->prepare("DELETE FROM question WHERE id_question = :id");

        
        $stmt->bindParam(':id', $qstId);
        $stmt->execute();
        header("Location: dashboardUser.php");
        exit();
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


$conn = null;
?>