<?php
require_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ans'])) {
    
    $repId = $_GET['ans'];
    $qst = $_GET['qst'];
    try {
        
        $conn->begin_transaction();
        
        $del_reaction = $conn->prepare("DELETE FROM reaction WHERE id_reponse = ?");
        $del_reaction->bind_param('i' , $repId);
        $del_reaction->execute();
        
        $stmt = $conn->prepare("DELETE FROM reponse WHERE id_reponse = ?");
        $stmt->bind_param('i', $repId);
        $stmt->execute();
        
        $conn->commit();
        header("Location: Answers.php?question_id={$qst}");
        exit();
    }
    catch(mysqli_sql_exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>