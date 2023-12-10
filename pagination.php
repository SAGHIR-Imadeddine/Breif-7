
<?php
    include 'connection.php';
    session_start();
    $user = $_SESSION["id"];

    $items_per_page = 2;

    $page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;
    $offset = ($page - 1) * $items_per_page;

    $query = "SELECT q.id_question, q.tittre AS title, q.description AS question_description, q.datecreation, u.image AS user_image, u.firstName AS user_firstName, u.lastName AS user_lastName ,q.ID_User
            FROM question q
            JOIN users u ON q.ID_User = u.id_user
            LIMIT $offset, $items_per_page";

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $questionId = $row['id_question'];
?>
            <div class="bg-white p-6 rounded-md shadow-md mb-4">
                <h2 class="text-xl font-semibold mb-2"><?= $row['title'] ?></h2>
                <p class="text-gray-600"><?= $row['question_description'] ?></p>

                <div class="flex items-center mt-4">
                    <div class="flex items-center">
                        <img src="<?= $row['user_image'] ?>" alt="User Avatar" class="rounded-full w-8 h-8 mr-2">
                        <span class="text-gray-700"><?= $row['user_firstName'] . ' ' . $row['user_lastName'] ?></span>
                    </div>

                    <div class="text-gray-500 ml-4">
                        <span>Created on: <?= date('M j, Y', strtotime($row['datecreation'])) ?></span>
                    </div>
                </div>

                <div class="flex flex-row gap-5 justify-end items-center">
                <a href="Answers.php?question_id=<?= $questionId ?>" class="questionDiv p-2 px-4 bg-blue-500 rounded text-white questionDiv">Answers</a>

                <?php
                    if($user == $row['ID_User']){
                        echo "<a href='modifQST.php?qst_id={$row['id_question']}' class='questionDiv p-2 px-4 bg-orange-500 rounded text-white questionDiv'>modifier</a>
                              <a href='./delQST.php?qst_id={$row['id_question']}'  class='questionDiv p-2 px-4 bg-red-600 rounded text-white questionDiv'>supprimer</a>";
                    }
                    ?>

                </div>

                <div class="flex items-center mb-4">
                    <?php
                        $tagsQuery = "SELECT tag_name FROM tagquetion tq JOIN tag t ON tq.ID_Tag = t.id_tag WHERE tq.ID_Question = $questionId";
                        $tagsResult = mysqli_query($conn, $tagsQuery);

                        if ($tagsResult) {
                            while ($tagRow = mysqli_fetch_assoc($tagsResult)) {
                    ?>
                                <span class="text-sm font-semibold text-blue-500 bg-blue-100 rounded-full px-3 py-1 mr-2"><?= $tagRow['tag_name'] ?></span>
                    <?php
                            }

                            mysqli_free_result($tagsResult);
                        } else {
                            echo 'Error executing the tags query: ' . mysqli_error($conn);
                        }
                    ?>
                </div>
            </div>
<?php
        }
        mysqli_free_result($result);

        // Add pagination links
        $pagination_query = "SELECT COUNT(*) as total_rows FROM question";
        $pagination_result = mysqli_query($conn, $pagination_query);
        $pagination_row = mysqli_fetch_assoc($pagination_result);
        $total_rows = $pagination_row['total_rows'];
        $total_pages = ceil($total_rows / $items_per_page);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
?>
            <a href="#" id="<?= $i ?>" class="p-2 px-4 text-white bg-blue-500 rounded mr-2"><?= $i ?></a>
<?php
        }
        echo '</div>';
    } else {
        echo 'Error executing the main query: ' . mysqli_error($conn);
    }
?>

