<?php
session_start();
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit; 
}

$idproject = 0;
$iduser = 0;
if (isset($_GET["idproject"]) && isset($_GET["iduser"])) {
    $idproject = $_GET["idproject"];
    $iduser = $_GET["iduser"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" contents="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="./js/dashboard.js" defer></script>
    <script src="https://kit.fontawesome.com/736a1ef302.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    animation: {
                        "slide-in-right": "slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940)   both",
                        "slide-out-right": "slide-out-right 0.5s cubic-bezier(0.550, 0.085, 0.680, 0.530)   both",
                        "pulsate-fwd": "pulsate-fwd 0.5s ease  infinite both",
                        "roll-in-top": "roll-in-top 0.6s ease   both",
                        "swing-in-top-fwd": "swing-in-top-fwd 2s cubic-bezier(0.175, 0.885, 0.320, 1.275)   both"
                    },
                    keyframes: {
                        "slide-in-right": {
                            "0%": {
                                transform: "translateX(1000px)",
                                opacity: "0"
                            },
                            to: {
                                transform: "translateX(0)",
                                opacity: "1"
                            }
                        },
                        "slide-out-right": {
                            "0%": {
                                transform: "translateX(0)",
                                opacity: "1"
                            },
                            to: {
                                transform: "translateX(1000px)",
                                opacity: "0"
                            }
                        },
                        "pulsate-fwd": {
                            "0%,to": {
                                transform: "scale(1)"
                            },
                            "50%": {
                                transform: "scale(1.1)"
                            }
                        },

                        "roll-in-top": {
                            "0%": {
                                transform: "translateY(-800px) rotate(-540deg)",
                                opacity: "0"
                            },
                            to: {
                                transform: "translateY(0) rotate(0deg)",
                                opacity: "1"
                            }
                        },
                        "swing-in-top-fwd": {
                            "0%": {
                                transform: "rotateX(-100deg)",
                                "transform-origin": "top",
                                opacity: "0"
                            },
                            to: {
                                transform: "rotateX(0deg)",
                                "transform-origin": "top",
                                opacity: "1"
                            }
                        }
                    }
                }
            }
        }
    </script>
</head>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #1e40af;
        }

        .cta-btn {
            color: #1e40af;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a class="text-white text-3xl font-semibold uppercase hover:text-gray-300"><img src="./img/white3.png" alt=""></a>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a class="flex items-center active-nav-link text-white py-4 pl-6 nav-item cursor-pointer" id="TeamsBtn">
                <i class="fa-solid fa-users mr-3"></i>
                Teams
            </a>
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" id="MembersBtn">
                <i class="fa-solid fa-user-group mr-3"></i>
                Members
            </a>
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" id="ProjectsBtn">
                <i class="fa-solid fa-list-check mr-3"></i>
                Projects
            </a>
            <a class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" id="QuestionsBtn">
                <i class="fa-solid fa-circle-question mr-3"></i>
                Questions
            </a>
        </nav>
        <a href="logout.php" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Sign Out
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-blue-950 py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <!-- <img src="./img/abdellah.png"> -->
                    <?php
                    include 'connection.php';


                    $image = $_SESSION['image'];
                    echo "<img src='$image'>";
                    ?>
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">DATAWARE</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a class="flex items-center active-nav-link text-white py-2 pl-4 nav-item" id="TeamsBtn2">
                    <i class="fa-solid fa-users mr-3"></i>
                    Teams
                </a>
                <a class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item" id="ProjectsBtn2">
                    <i class="fa-solid fa-list-check mr-3"></i>
                    Projects
                </a>
                <button onclick="window.location.href='logout.php';" class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-sign-out-alt mr-3"></i> Sign Out
                </button>
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full grid grid-flow-row grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-6" id="TeamsTable">
                <h1 class="text-3xl text-black pb-6 col-span-3">Your teams</h1>

                <?php
                include 'connection.php';

                $equipeID = $_SESSION['equipeID'];
                $sql = "SELECT * FROM teams WHERE id_team = $equipeID";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $teamImg = $row['image'];
                    $teamDescription = $row['description'];
                    $teamName = $row['teamName'];
                    $projectID = $row['projectID'];
                    $scrumMasterID = $row['scrumMasterID'];

                    $scrumMasterQuery = "SELECT * FROM users WHERE id_user = $scrumMasterID";
                    $scrumMasterResult = $conn->query($scrumMasterQuery);

                    if ($scrumMasterResult->num_rows > 0) {
                        $scrumMasterData = $scrumMasterResult->fetch_assoc();
                        $scrumMasterFirstName = $scrumMasterData['firstName'];
                        $scrumMasterLastName = $scrumMasterData['lastName'];
                        $scrumMasterImg = $scrumMasterData['image'];
                    } else {
                        $scrumMasterFirstName = 'N/A';
                        $scrumMasterLastName = 'N/A';
                    }
                    echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">';
                    echo '<a href="#">';
                    echo "<img class='rounded-t-lg' src='$teamImg' alt='' />";
                    echo '</a>';
                    echo '<div class="p-5">';
                    echo '<div class = "flex justify-between">';
                    echo '<a href="#" class = "flex flex-col">';
                    echo "<h5 class='text-2xl font-bold tracking-tight text-gray-900'>$teamName</h5>";
                    echo "<p class = 'mb-4 text-green-900'><i class='fa-solid fa-user-pen pr-2'></i>$scrumMasterFirstName $scrumMasterLastName</p>";
                    echo '</a>';
                    echo '';
                    echo "<img src='$scrumMasterImg' alt='' class = 'w-[14%] h-[14%] rounded-full border-2 border-green-700 relative'>";
                    echo '</div>';
                    echo "<p class='mb-3 font-normal text-gray-700'>$teamDescription</p>";
                    echo '<div class = "flex flex-row items-center justify-between">';
                    echo '<div>';
                    echo '<a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">';
                    echo 'View members';
                    echo '<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                    echo '</a>';
                    echo '</svg>';
                    echo '</div>';
                    echo '<div class = "flex flex-col">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </main>

            <main class="w-full grid grid-flow-row grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-6 hidden" id="ProjectsTable">
                <h1 class="text-3xl text-black pb-6 col-span-3">Your projects</h1>



            </main>
            <section class="formajouterquestion  fixed inset-0 bg-gray-500 bg-opacity-75 overflow-y-auto blur-10 w-full h-[100vh]">
                <div class="flex items-center justify-center  min-h-screen">
                    <?php


                    if (isset($_POST["submit_question"])) {

                        $title = $_POST['titre'];

                        $description = $_POST['description'];

                        $tagsId = $_POST['tagIds'];
                        $explodedTags = explode(",", $tagsId);

                        $insertQuestionQuery = "INSERT INTO question(datecreation,ID_User,tittre, description,id_project) VALUES (current_date(),'$iduser','$title','$description','$idproject')";
                        $result = mysqli_query($conn, $insertQuestionQuery);
                        $idquestion = mysqli_insert_id($conn);
                        $sqlSelectAll = "SELECT id_tag FROM tag";
                        $resultAll = $conn->query($sqlSelectAll);

                        if ($resultAll) {
                            $allTagIds = [];
                            while ($row = $resultAll->fetch_assoc()) {
                                $allTagIds[] = $row['id_tag'];
                            }
                        }
                        $existedTagsIds = array_intersect($allTagIds, $explodedTags);
                        foreach ($existedTagsIds as $tagId) {
                            $tablepivot = "INSERT INTO tagquetion VALUES('$idquestion','$tagId')";
                            $conn->query($tablepivot);
                        }
                        if (count($existedTagsIds) > 0) {
                            echo '<script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Success",
                                    text: "Question added successfully!",
                                });
                            </script>';
                        } else {
                            echo '<script>
                                Swal.fire({
                                    icon: "warning",
                                    title: "Warning",
                                    text: "Question did not insert.",
                                });
                            </script>';
                        }
                    } else {
                        echo '<script>alert("Error fetching tags: ' . $conn->error . '");</script>';
                    }
                    ?>
                    <form class="w-[70%]" action="" method="post">
                        <div class="w-[80%] p-12 z-10 mx-[10%] bg-white">

                            <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm  ">
                                <input type="hidden" name="project_id" value="<?php echo $projectID; ?>">
                                <label for="titre" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">titre</label>
                                <input type="text" name="titre" id="titre" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Titre">
                            </div>


                            <input type="text" name="tagIds" id="tagIds" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Titre">

                            <div class="mt-2 border border-gray-300 rounded-md px-3 relative">
                                <label for="tags" class="block text-sm font-medium text-gray-700 absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium">Tags</label>
                                <div id="tagsContainer" class="flex flex-wrap mb-2">
                                </div>
                                <input type="text" id="tags" name="tags" class="mt-1 p-2 w-full border rounded-md" placeholder="Add tags">
                            </div>

                            <div class="mt-2">
                                <textarea rows="8" name="description" id="description" class="block w-full border-2 border-gray-300 rounded-md py-1 resize-none placeholder-gray-500 focus:ring-0 pl-2 sm:text-sm" placeholder="Write a description..."></textarea>
                            </div>

                            <div>
                                <input class="hover:bg-green-400 p-2 mt-2 text-center text-black text-xs font-medium bg-gray-200 rounded-full" name="submit_question" type="submit" value="Submit Question">
                            </div>
                        </div>

                    </form>
                </div>
            </section>








        </div>


        <script>
         


            const tagsContainer = document.getElementById("tagsContainer");
            const tagsInput = document.getElementById("tags");
            const tagIds = document.getElementById('tagIds');

            tagsInput.addEventListener("keydown", function(event) {
                if (event.key === " " && tagsInput.value.trim() !== "") {
                    const tagName = tagsInput.value.trim();
                    const lastTag = tagName.split(' ');
                    console.log(lastTag[lastTag.length - 1]);


                    fetch("insert_tag.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: `tagName=${encodeURIComponent(lastTag)}`,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log("sdcfvghbjnk,")
                                const tagElement = document.createElement("div");
                                tagElement.className = "bg-blue-500 text-white p-1 rounded-md m-1";
                                tagElement.textContent = lastTag;
                                tagIds.value += data.tagID + ",";
                                const removeButton = document.createElement("button");
                                removeButton.className = "ml-1 text-xs";
                                removeButton.textContent = "Remove";
                                removeButton.addEventListener("click", function(event) {
                                    event.preventDefault(); // Prevent the default behavior of the button click
                                    console.log(`tagID=${data.tagID}`);
                                    // Make an AJAX request to remove the &tag from the database
                                    fetch("remove_tag.php", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/x-www-form-urlencoded",
                                            },
                                            body: `tagID=${data.tagID}`,
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {

                                                // Remove the tag element from the container
                                                tagsContainer.removeChild(tagElement);
                                                Swal.fire({
                                                icon: "success",
                                                title: "Tag Deleted Successfully",
                                                showConfirmButton: false,// button
                                                timer: 1500
                                                });
                                            } else {
                                                console.error("Error removing tag:", data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error("Error removing tag:", error);
                                        });
                                });

                                // Append the remove button to the tag element
                                tagElement.appendChild(removeButton);

                                // Append the tag element to the tags container
                                tagsContainer.appendChild(tagElement);

                                // Clear the input field
                                tagsInput.value = "";
                            } else {
                                console.error("Error inserting tag:", data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error inserting tag:", error);
                        });
                }
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>