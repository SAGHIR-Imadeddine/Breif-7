<?php
    session_start();
    include 'connection.php';

    // Number of items per page
    $items_per_page = 2;

    // Current page (default to 1 if not set)
    $page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

    // Calculate the offset
    $offset = ($page - 1) * $items_per_page;

    $query = "SELECT q.id_question, q.tittre AS title, q.description AS question_description, q.datecreation, u.image AS user_image, u.firstName AS user_firstName, u.lastName AS user_lastName
            FROM question q
            JOIN users u ON q.ID_User = u.id_user
            WHERE Archif = 1
            LIMIT $offset, $items_per_page";

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $questionId = $row['id_question'];

            echo '<div class="bg-white p-6 rounded-md shadow-md mb-4">';
            echo '<h2 class="text-xl font-semibold mb-2">' . $row['title'] . '</h2>';
            echo '<p class="text-gray-600">' . $row['question_description'] . '</p>';

            echo '<div class="flex items-center mt-4">';
            echo '<div class="flex items-center">';
            echo '<img src="' . $row['user_image'] . '" alt="User Avatar" class="rounded-full w-8 h-8 mr-2">';
            echo '<span class="text-gray-700">' . $row['user_firstName'] . ' ' . $row['user_lastName'] . '</span>';
            echo '</div>';

            echo '<div class="text-gray-500 ml-4">';
            echo '<span>Created on: ' . date('M j, Y', strtotime($row['datecreation'])) . '</span>';
            echo '</div>';
            echo '</div>';

            echo '<div class="flex flex-row gap-5 justify-end items-center">';
            echo '<a href="#" class="questionDiv p-2 px-4 bg-blue-500 rounded text-white questionDiv"><i class="fa-solid fa-comments mr-2"></i>Answers</a>';

            if ($_SESSION['role'] == "scrumMaster") {
                echo '<a href="./archive.php?id='. $row['id_question'] .'" class="questionDiv p-2 px-4 bg-red-500 rounded text-white questionDiv"><i class="fa-solid fa-trash mr-2"></i>Archive</a>';
                echo '</div>';
            } else {
                echo '</div>';
            }

            echo '<div class="flex items-center mb-4">';
                $tagsQuery = "SELECT tag_name FROM tagquetion tq JOIN tag t ON tq.ID_Tag = t.id_tag WHERE tq.ID_Question = $questionId";
                $tagsResult = mysqli_query($conn, $tagsQuery);

                if ($tagsResult) {
                    while ($tagRow = mysqli_fetch_assoc($tagsResult)) {
                        echo '<span class="text-sm font-semibold text-blue-500 bg-blue-100 rounded-full px-3 py-1 mr-2">' . $tagRow['tag_name'] . '</span>';
                    }

                    mysqli_free_result($tagsResult);
                } else {
                    echo 'Error executing the tags query: ' . mysqli_error($conn);
                }

            echo '</div>';
            echo '</div>';
        }
        mysqli_free_result($result);

        // Add pagination links
        $pagination_query = "SELECT COUNT(*) as total_rows FROM question WHERE Archif = 1";
        $pagination_result = mysqli_query($conn, $pagination_query);
        $pagination_row = mysqli_fetch_assoc($pagination_result);
        $total_rows = $pagination_row['total_rows'];
        $total_pages = ceil($total_rows / $items_per_page);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="#" id="' . $i . '" class = "p-2 px-4 text-white bg-blue-500 rounded mr-2">' . $i . '</a>';
        }
        echo '</div>';
    } else {
        echo 'Error executing the main query: ' . mysqli_error($conn);
    }
?>