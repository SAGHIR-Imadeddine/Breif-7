<?php
session_start();
include 'connection.php';
// include 'userCheck.php';
$questionId = $_GET['questionId'];

$select = "SELECT * FROM question,users where question.id_user = users.ID_user and id_question = $questionId;";
$stmt = $conn->prepare($select);
$stmt->execute();
$result = $stmt->get_result();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tittre = $row['tittre'];
        $description = $row['description'];
        $datecreation = $row['datecreation'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <script>

    </script>
</head>

<body>
    <div class="bg-white p-6 rounded-md shadow-md mb-4">
        <div class="flex items-center mb-4">
            <span class="text-sm font-semibold text-blue-500 bg-blue-100 rounded-full px-3 py-1 mr-2">html</span>
            <span class="text-sm font-semibold text-green-500 bg-green-100 rounded-full px-3 py-1 mr-2">tailwind-css</span>
        </div>
        <h2 class="text-xl font-semibold mb-2"></h2>
        <p class="text-gray-600">ssssssssssssssssss</p>
        <div class="flex items-center mt-4">
            <div class="flex items-center">
                <img src="https://placekitten.com/40/40" alt="User Avatar" class="rounded-full w-8 h-8 mr-2">
                <span class="text-gray-700">John Doe</span>
            </div>
            <div class="text-gray-500 ml-4">
                <span>12 votes</span>
                <span class="mx-2">•</span>
                <span>3 answers</span>
            </div>
        </div>
</body>

</html>