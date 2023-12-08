<?php
require_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_reponse'])) {
    
    $repId = $_GET['id_reponse'];

    try {
        
        $stmt = $conn->prepare("DELETE FROM reponse WHERE id_reponse = :id");

        
        $stmt->bindParam(':id', $repId);
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