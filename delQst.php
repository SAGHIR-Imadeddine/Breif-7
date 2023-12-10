<?php
require_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_question'])) {

    $qstId = $_GET['id_question'];

    try {
        $conn->begin_transaction();

        $del_answer = $conn->prepare("DELETE FROM reponse WHERE id_qst = ?");
        $del_answer->bind_param('i', $qstId);
        $del_answer->execute();

        $del_reaction = $conn->prepare("DELETE FROM reaction WHERE id_qst = ?");
        $del_reaction->bind_param('i', $qstId);
        $del_reaction->execute();

        $del_question = $conn->prepare("DELETE FROM question WHERE id_question = ?");
        $del_question->bind_param('i', $qstId);
        $del_question->execute();

        $conn->commit();
        header("Location: dashboardUser.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>

        
        