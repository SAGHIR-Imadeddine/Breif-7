<?php
session_start();
include 'connection.php';
// include 'userCheck.php';

$select = "SELECT * FROM question JOIN users ON question.id_user = users.id_user";
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

        echo '
    <div class="flex flex-col justify-evenly items-start h-40 border-2 border-black rounded-xl px-4 md:px-10 shadow-xl bg-slate-100">
        <div>
            <h1 class="text-xl font-medium">'.$tittre.'</h1>
        </div>
        <div>
            <p>'.$description.'</p>
        </div>
        <div class="flex justify-between items-center w-full">
            <div>
                Tags
            </div>
            <div class="flex gap-4">
                <div>
                    <p>'.$firstName.' '.$lastName.'</p>
                </div>
                <div>
                    20 Likes
                </div>
                <div>
                    '.$datecreation.'
                </div>
            </div>
        </div>
    </div>
        ';
    }
} else {
    echo 'No questions in database';
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
    <div class="w-[60%] mx-auto">
        <div class="flex flex-col justify-evenly items-start h-40 border-2 border-black rounded-xl px-4 md:px-10 shadow-xl bg-slate-100">
            <div>
                <h1 class="text-xl font-medium">Title Lorem ipsum dolor sit amet consectetur</h1>
            </div>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, iusto qui ipsa ducimus in inventore maiores atque animi sit eligendi, expedita praesentium! Incidunt eaque perspiciatis asperiores accusamus quas? Iusto, tempore.</p>
            </div>
            <div class="flex justify-between items-center w-full">
                <div>
                    Tags
                </div>
                <div class="flex gap-4">
                    <div>
                        User
                    </div>
                    <div>
                        20 Likes
                    </div>
                    <div>
                        12/12/2012
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>