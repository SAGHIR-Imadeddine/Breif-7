<?php
include('connection.php');
        $userId = $_POST['selectedId']; 
        $questionId =$_POST['questionId'] ; 
        
        
        $responseDescription = $_POST['description'];
        
        
        $sql = "INSERT INTO reponse (datecreation, reponse, user_id_reponse, id_qst, archife) VALUES (CURRENT_DATE, '$responseDescription', $userId, $questionId, 1)";

        
        if ($conn->query($sql) === TRUE) {
            echo "Response added successfully!";
            header('Location: dashboardUser.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
 ?>       