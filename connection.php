<?php
$servername = "localhost";
$username = "id21625295_root";
$password = "AbdellahTalemsi@123";
$dbname = "id21625295_datawaresite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
   
}
?>