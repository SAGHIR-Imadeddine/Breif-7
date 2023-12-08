<?php
include 'connection.php';

$query = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
          FROM projects p
          LEFT JOIN question q ON p.id_project = q.id_project
          GROUP BY p.id_project, p.name";
$result = mysqli_query($conn, $query);

if ($result) {
   
    while ($row = mysqli_fetch_assoc($result)) {
        $idProject = $row['id_project'];
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];

    //    Project ID: $idProject,
     
        echo '  <dt class="text-sm font-medium text-gray-500 truncate">';
        echo "Project Name: $projectName";
        echo '  </dt>';
        echo '  <dd class="mt-1 text-3xl font-semibold text-gray-900">';
        echo "    Question Count: $questionCount";
        echo '  </dd>';
       }

    mysqli_free_result($result);
} else {
    
    echo "Error executing query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>