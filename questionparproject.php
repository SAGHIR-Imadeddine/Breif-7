<?php
include 'connection.php';

// Récupération des projets avec le nombre de questions
$query = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
          FROM projects p
          LEFT JOIN question q ON p.id_project = q.id_project
          GROUP BY p.id_project, p.name";
$result = mysqli_query($conn, $query);

// Affichage des projets avec le nombre de questions
if ($result) {
    echo '<div class="flex flex-wrap justify-center">';
    while ($row = mysqli_fetch_assoc($result)) {
        $idProject = $row['id_project'];
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];

        echo '<div class="w-[300px] m-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">';
        echo "<h2 class='text-xl font-semibold text-gray-800'>$projectName</h2>";
        echo "<p class='text-sm text-gray-600'>Question Count: $questionCount</p>";
        echo '</div>';
    }
    echo '</div>';
    echo "<hr class='w-full h-1 my-4 bg-black border-0 rounded'>";
    mysqli_free_result($result);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Récupération des projets avec le plus grand nombre de questions (top 3)
$queryTopProjects = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
                     FROM projects p
                     LEFT JOIN question q ON p.id_project = q.id_project
                     GROUP BY p.id_project, p.name
                     ORDER BY question_count DESC
                     LIMIT 3";

$resultTopProjects = mysqli_query($conn, $queryTopProjects);

// Affichage des projets avec le plus grand nombre de questions (top 3)
if ($resultTopProjects) {
    echo '<h1 class="text-2xl font-semibold text-gray-800 my-4">Top Projects with Most Questions</h1>';
    echo '<div class="flex flex-wrap justify-center">';
    while ($row = mysqli_fetch_assoc($resultTopProjects)) {
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];

        echo '<div class="w-[300px] m-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">';
        echo "<h2 class='text-xl font-semibold text-gray-800'>$projectName</h2>";
        echo "<p class='text-sm text-gray-600'>Question Count: $questionCount</p>";
        echo '</div>';
    }
    echo '</div>';
    echo "<hr class='w-full h-1 my-4 bg-black border-0 rounded'>";
    mysqli_free_result($resultTopProjects);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Récupération du projet avec le moins de questions
$queryMinQuestions = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
                      FROM projects p
                      LEFT JOIN question q ON p.id_project = q.id_project
                      GROUP BY p.id_project, p.name
                      ORDER BY question_count ASC
                      LIMIT 1";

$resultMinQuestions = mysqli_query($conn, $queryMinQuestions);

// Affichage du projet avec le moins de questions
if ($resultMinQuestions) {
    echo '<h1 class="text-2xl font-semibold text-gray-800 my-4">Project with Fewest Questions</h1>';
    echo '<div class="flex flex-wrap justify-center">';
    while ($row = mysqli_fetch_assoc($resultMinQuestions)) {
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];

        echo '<div class="w-[300px] m-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">';
        echo "<h2 class='text-xl font-semibold text-gray-800'>$projectName</h2>";
        echo "<p class='text-sm text-gray-600'>Question Count: $questionCount</p>";
        echo '</div>';
    }
    echo '</div>';
    echo "<hr class='w-full h-1 my-4 bg-black border-0 rounded'>";
    mysqli_free_result($resultMinQuestions);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

// Récupération de l'utilisateur avec le plus grand nombre de réponses
$queryTopUser = "SELECT users.id_user, users.firstName, users.lastName, COUNT(reponse.id_reponse) AS nombre_reponses
                 FROM users
                 LEFT JOIN reponse ON users.id_user = reponse.user_id_reponse
                 GROUP BY users.id_user, users.firstName, users.lastName
                 ORDER BY nombre_reponses DESC
                 LIMIT 1";

$resultTopUser = mysqli_query($conn, $queryTopUser);

// Affichage de l'utilisateur avec le plus grand nombre de réponses
if ($resultTopUser) {
    echo '<h1 class="text-2xl font-semibold text-gray-800 my-4">Top User with Most Responses</h1>';
    echo '<div class="flex flex-wrap justify-center">';
    while ($row = mysqli_fetch_assoc($resultTopUser)) {
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $responseCount = $row['nombre_reponses'];

        echo '<div class="w-[300px] m-4 bg-white shadow rounded-lg overflow-hidden sm:p-6">';
        echo "<h2 class='text-xl font-semibold text-gray-800'>$firstName $lastName</h2>";
        echo "<p class='text-sm text-gray-600'>Response Count: $responseCount</p>";
        echo '</div>';
    }
    echo '</div>';
    echo "<hr class='w-full h-1 my-4 bg-black border-0 rounded'>";
    mysqli_free_result($resultTopUser);
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
