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
        //echo '  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6" >';
        echo '  <dt class="text-sm font-medium text-gray-500 truncate">';
        echo "Project Name: $projectName";
        echo '  </dt>';
        echo '  <dd class="mt-1 text-3xl font-semibold text-gray-900">';
        echo "    Question Count: $questionCount";
        echo '  </dd>';
        // echo '</div>';
        
        


       } echo"<hr>";
       mysqli_free_result($result);
} else {

    echo "Error executing query: " . mysqli_error($conn);
}




$query1 = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
FROM projects p
LEFT JOIN question q ON p.id_project = q.id_project
GROUP BY p.id_project, p.name
ORDER BY question_count DESC
LIMIT 3";

$result2 = mysqli_query($conn, $query1);

if ($result2) {
echo '<h1>les projets avec le plus de questions</h1>';
    while ($row = mysqli_fetch_assoc($result2)) {
        $idProject = $row['id_project'];
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];



            // echo '  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6" >';

            
            echo '  <dt class="text-sm font-medium text-gray-500 truncate">';
            echo "Project Name: $projectName";
            echo '  </dt>';
            echo '  <dd class="mt-1 text-3xl font-semibold text-gray-900">';
            echo "    Question Count: $questionCount";
            echo '  </dd>';
            // echo '</div>';
        

    }} else {

        echo "Error executing query: " . mysqli_error($conn);
    }
    

$query1 = "SELECT p.id_project, p.name AS project_name, COUNT(q.id_question) AS question_count
FROM projects p
LEFT JOIN question q ON p.id_project = q.id_project
GROUP BY p.id_project, p.name
ORDER BY question_count ASC
LIMIT 1";

$result2 = mysqli_query($conn, $query1);

if ($result2) {
echo '<h1>le projet avec le moin de questions</h1>';
    while ($row = mysqli_fetch_assoc($result2)) {
        $idProject = $row['id_project'];
        $projectName = $row['project_name'];
        $questionCount = $row['question_count'];



            // echo '  <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6" >';

            
            echo '  <dt class="text-sm font-medium text-gray-500 truncate">';
            echo "Project Name: $projectName";
            echo '  </dt>';
            echo '  <dd class="mt-1 text-3xl font-semibold text-gray-900">';
            echo "    Question Count: $questionCount";
            echo '  </dd>';
            // echo '</div>';
        

    }} else {

        echo "Error executing query: " . mysqli_error($conn);
    }
mysqli_close($conn);
?>
