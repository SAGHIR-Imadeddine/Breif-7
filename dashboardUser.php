<?php
session_start();
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
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
            <form class="w-full">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative flex">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="default-search" class="inline w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="search" required>

                </div>


            </form>
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
            <div class="flex items-center justify-evenly gap-8">
                <a href="index.html" class="text-white text-xl font-semibold uppercase hover:text-gray-300 max-w-[100px]">DATAWARE</a>



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

                // Check if the user is logged in
                // User is logged in
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
                        // Handle the case where the scrum master is not found
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

                <?php




                // Check if the user is logged in
                // User is logged in
                $equipeID = $_SESSION['equipeID'];
                $sql = "SELECT projectID FROM teams WHERE id_team = $equipeID";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $projectID = $row['projectID'];
                    $currentMemberID = $_SESSION['id'];

                    $projectsQuery = "SELECT * FROM projects WHERE id_project = $projectID";
                    $projectsResult = $conn->query($projectsQuery);

                    if ($projectsResult->num_rows > 0) {
                        while ($projectsData = $projectsResult->fetch_assoc()) {
                            $projectsImg = $projectsData['image'];
                            $projectsName = $projectsData['name'];
                            $projectsDesc = $projectsData['description'];
                            $projectsScrum = $projectsData['scrumMasterID'];
                            $projectsProd = $projectsData['productOwnerID'];
                            $projectsDateStart = $projectsData['date_start'];
                            $projectsDateEnd = $projectsData['date_end'];
                            $projectsStatus = $projectsData['statut'];

                            $scrumMasterQuery = "SELECT * FROM users WHERE id_user = $projectsScrum";
                            $scrumMasterResult = $conn->query($scrumMasterQuery);

                            if ($scrumMasterResult->num_rows > 0) {
                                $scrumMasterData = $scrumMasterResult->fetch_assoc();
                                $scrumMasterFirstName = $scrumMasterData['firstName'];
                                $scrumMasterLastName = $scrumMasterData['lastName'];
                                $scrumMasterImg = $scrumMasterData['image'];
                            } else {
                                // Handle the case where the scrum master is not found
                                $scrumMasterFirstName = 'N/A';
                                $scrumMasterLastName = 'N/A';
                            }

                            $prodMasterQuery = "SELECT * FROM users WHERE id_user = $projectsProd";
                            $prodMasterResult = $conn->query($prodMasterQuery);

                            if ($prodMasterResult->num_rows > 0) {
                                $prodMasterData = $prodMasterResult->fetch_assoc();
                                $prodMasterFirstName = $prodMasterData['firstName'];
                                $prodMasterLastName = $prodMasterData['lastName'];
                                $prodMasterImg = $prodMasterData['image'];
                            } else {
                                // Handle the case where the scrum master is not found
                                $prodMasterFirstName = 'N/A';
                                $prodMasterLastName = 'N/A';
                            }

                            echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">';
                            echo '<a href="#">';
                            echo "<img class='rounded-t-lg' src='$projectsImg' alt='' />";
                            echo '</a>';
                            echo '<div class="p-5">';
                            echo '<div class="flex justify-between">';
                            echo '<a href="#" class="flex flex-col">';
                            echo "<h5 class='text-2xl font-bold tracking-tight text-gray-900'>$projectsName</h5>";
                            echo "<p class='text-red-900'><i class='fa-solid fa-user-gear pr-2'></i>$prodMasterFirstName $prodMasterLastName</p>";
                            echo "<p class='mb-4 text-green-900'><i class='fa-solid fa-user-pen pr-2'></i>$scrumMasterFirstName $scrumMasterLastName</p>";
                            echo '</a>';
                            echo '';
                            echo "<img src='$prodMasterImg' alt='' class='w-[14%] h-[14%] rounded-full border-2 border-red-700 relative'>";
                            echo '</div>';
                            echo "<p class='mb-3 font-normal text-gray-700'>$projectsDesc</p>";
                            echo '<div class="flex flex-row items-center justify-between">';
                            echo '<div>';
                            echo '<a href="#" class="projectQue inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" onclick="sendData(' . $projectsData['id_project'] . ')" data-id="' . $projectsData['id_project'] . '">';
                            echo 'View project questions';
                            echo '<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                            echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                            echo '</a>';
                            echo '</svg>';
                            echo '</div>';
                            echo '<div class="flex flex-col items-center">';
                            echo "   <a href='ajouterquestion.php?idproject=$projectID &iduser=$currentMemberID '><button id='btnajoutquestion' class='p-2 w-fit h-fit text-center text-black text-xs font-medium bg-green-400 rounded-full'>+ QUESTION</button></a>";
                            echo "<p class='text-gray-500'>$projectsDateStart</p>";
                            echo "<p class='text-gray-500'>$projectsDateEnd</p>";
                            if ($projectsStatus == 'Active') {
                                echo '<p class="text-green-500">Active</p>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        // Handle the case where no projects are found for the current user
                    }

                ?>

            </main>

        <?php  } ?>


        <div class="min-w-0 flex-1">




            <main class="w-full grid grid-flow-row grid-cols-1 md:grid-cols-2 lg:grid-cols-5 p-6 justify-center items-center hidden gap-5" id="MembersTable">
                <h1 class="text-3xl text-black pb-6 col-span-1 md:col-span-2 lg:col-span-5">Members</h1>
                <?php
                include 'connection.php';
                $equipeID = $_SESSION['equipeID'];
                $sql = "SELECT * FROM teams WHERE id_team = $equipeID";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $teamImg = $row['image'];
                    $teamName = $row['teamName'];
                    $scrumMasterID = $row['scrumMasterID'];
                    $teamId = $row['id_team'];

                    echo '
                            <div class="w-full h-48 col-span-1 md:col-span-2 lg:col-span-5 bg-white border border-gray-200 rounded-lg shadow sticky top-0" style = "background-image: url(' . $teamImg . '); background-position-x: center; background-position-y: 20%; background-repeat: no-repeat; background-size: cover;">
                                <div class = "w-full h-fit bg-gray-800 py-2 rounded-t">
                                    <p class = "text-white text-center">' . $teamName . '</p>
                                </div>
                            </div>';



                    $MembersQuery = "SELECT * FROM users WHERE equipeID = $teamId";
                    $MembersResult = $conn->query($MembersQuery);

                    while ($MembersData = $MembersResult->fetch_assoc()) {
                        if ($MembersResult->num_rows > 0) {
                            $MembersFirstName = $MembersData['firstName'];
                            $MembersLastName = $MembersData['lastName'];
                            $MembersImg = $MembersData['image'];
                            if ($MembersData['role'] == 'user') {
                                $MembersRole = "User";
                                $MembersIcon = "fa-solid fa-user mr-2";
                                $MembersColor = "gray";
                            } else if ($MembersData['role'] == 'scrumMaster') {
                                $MembersRole = "Scrum Master";
                                $MembersIcon = "fa-solid fa-user-pen pr-2";
                                $MembersColor = "green";
                            } else if ($MembersData['role'] == 'prodOwner') {
                                $MembersRole = "Product Owner";
                                $MembersIcon = "fa-solid fa-user-gear pr-2";
                                $MembersColor = "red";
                            }
                        } else {
                            // Handle the case where the scrum master is not found
                            $MembersFirstName = 'N/A';
                            $MembersLastName = 'N/A';

                        }
                        echo '
                                <div class="w-full max-w-sm bg-white border border-gray-100 rounded-lg shadow">
                                    <div class="flex flex-col items-center pb-2">
                                        <div class = "flex flex-row justify-between px-2 py-2 mb-2 bg-gray-800 rounded-t border border-gray-100">
                                            <p class = "text-white font-bold"><i class="fa-solid fa-flag mr-2"></i>' . $teamName . '</p>
                                            <img src="' . $teamImg . '" alt="" class = "rounded-full h-1/6 w-1/6">
                                        </div>
                                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="' . $MembersImg . '" alt="' . $MembersFirstName . ' ' . $MembersLastName . '"/>
                                        <h5 class="mb-1 text-xl font-medium text-' . $MembersColor . '-900">' . $MembersFirstName . ' ' . $MembersLastName . '</h5>
                                        <span class="text-sm text-' . $MembersColor . '-500"><i class="' . $MembersIcon . '"></i>' . $MembersRole . '</span>
                                    </div>
                                    <div class="flex pb-2 justify-center">
                                    <form method = "POST" action = "remove.php">
                                        <input type="hidden" name="userID" value="' . $MembersData['id_user'] . '">
                                    </form>
                                    </div>
                                </div>
                                ';
                    }
                }
              ?>

        <main class="w-full flex flex-col p-6 hidden" id="QuestionsTable">
            <div class="col-span-3 pb-6 flex flex-row justify-between">
                <h1 class="text-3xl text-black">Questions</h1>
            </div>
            <div class="flex flex-col gap-5" id = "result">  
             </div>


            </main>

            <main class="w-full grid grid-flow-row grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-6 hidden" id="ProjectsTable">
                <h1 class="text-3xl text-black pb-6 col-span-3">Your projects</h1>

                <?php
                include 'connection.php';

                // Check if the user is logged in
                // User is logged in
                $equipeID = $_SESSION['equipeID'];
                $sql = "SELECT projectID FROM teams WHERE id_team = $equipeID";

                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $projectID = $row['projectID'];

                    $projectsQuery = "SELECT * FROM projects WHERE id_project = $projectID";
                    $projectsResult = $conn->query($projectsQuery);


                    if ($projectsResult->num_rows > 0) {
                        $projectsData = $projectsResult->fetch_assoc();
                        $projectsImg = $projectsData['image'];
                        $projectsName = $projectsData['name'];
                        $projectsDesc = $projectsData['description'];
                        $projectsScrum = $projectsData['scrumMasterID'];
                        $projectsProd = $projectsData['productOwnerID'];
                        $projectsDateStart = $projectsData['date_start'];
                        $projectsDateEnd = $projectsData['date_end'];
                        $projectsStatus = $projectsData['statut'];
                    } else {
                        // Handle the case where the scrum master is not found
                    }

                    $scrumMasterQuery = "SELECT * FROM users WHERE id_user = $projectsScrum";
                    $scrumMasterResult = $conn->query($scrumMasterQuery);

                    if ($scrumMasterResult->num_rows > 0) {
                        $scrumMasterData = $scrumMasterResult->fetch_assoc();
                        $scrumMasterFirstName = $scrumMasterData['firstName'];
                        $scrumMasterLastName = $scrumMasterData['lastName'];
                        $scrumMasterImg = $scrumMasterData['image'];
                    } else {
                        // Handle the case where the scrum master is not found
                        $scrumMasterFirstName = 'N/A';
                        $scrumMasterLastName = 'N/A';
                    }


                    $prodMasterQuery = "SELECT * FROM users WHERE id_user = $projectsProd";
                    $prodMasterResult = $conn->query($prodMasterQuery);

                    if ($prodMasterResult->num_rows > 0) {
                        $prodMasterData = $prodMasterResult->fetch_assoc();
                        $prodMasterFirstName = $prodMasterData['firstName'];
                        $prodMasterLastName = $prodMasterData['lastName'];
                        $prodMasterImg = $prodMasterData['image'];
                    } else {
                        // Handle the case where the scrum master is not found
                        $prodMasterFirstName = 'N/A';
                        $prodMasterLastName = 'N/A';
                    }
                    echo '<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">';
                    echo '<a href="#">';
                    echo "<img class='rounded-t-lg' src='$projectsImg' alt='' />";
                    echo '</a>';
                    echo '<div class="p-5">';
                    echo '<div class = "flex justify-between">';
                    echo '<a href="#" class = "flex flex-col">';
                    echo "<h5 class='text-2xl font-bold tracking-tight text-gray-900'>$projectsName</h5>";
                    echo "<p class = 'text-red-900'><i class='fa-solid fa-user-gear pr-2'></i>$prodMasterFirstName $prodMasterLastName</p>";
                    echo "<p class = 'mb-4 text-green-900'><i class='fa-solid fa-user-pen pr-2'></i>$scrumMasterFirstName $scrumMasterLastName</p>";
                    echo '</a>';
                    echo '';
                    echo "<img src='$prodMasterImg' alt='' class = 'w-[14%] h-[14%] rounded-full border-2 border-red-700 relative'>";
                    echo '</div>';
                    echo "<p class='mb-3 font-normal text-gray-700'>$projectsDesc</p>";
                    echo '<div class = "flex flex-row items-center justify-between">';
                    echo '<div>';
                    echo '<a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">';
                    echo 'More details';
                    echo '<svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
                    echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
                    echo '</a>';
                    echo '</svg>';
                    echo '</div>';
                    echo '<div class = "flex flex-col items-center">';
                    echo "<p class = 'text-gray-500'>$projectsDateStart</p>";
                    echo "<p class = 'text-gray-500'>$projectsDateEnd</p>";
                    if ($projectsStatus == 'Active') {
                        echo '<p class = "text-green-500">Active</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </main>



            <main class="w-full flex flex-col p-6 hidden" id="QuestionsTable">
                <div class="col-span-3 pb-6 flex flex-row justify-between allquestions ">
                    <h1 class="text-3xl text-black">All questions</h1>
                    <a href="#" class="p-2 px-4 bg-blue-500 rounded text-white">My questions</a>
                </div>

                <div class="flex flex-col gap-5 allquestions" id="result">

                </div>
                <div id="search_result">
                </div>



            </main>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#default-search").keyup(function() {
                    var input = $(this).val();

                    if (input != "") {
                        // alert(input);

                        $.ajax({
                            url: "livesearch.php",
                            method: "POST",
                            data: {

                                input: input
                            },
                            success: function(data) {
                                $("#search_result").html(data);
                            }
                        });
                         $(".allquestions").hide();
                    $("#search_result").show()

                    } else {
                        $("#search_result").hide();
                        $(".allquestions").show();

                    }
                   
                })



            })
         
            const btnajoutquestion = document.getElementById("btnajoutquestion");
            const formajouterquestion = document.querySelector(".formajouterquestion");
            btnajoutquestion.addEventListener("click", () => {
                formajouterquestion.classList.remove("hidden");
            })

            document.addEventListener("DOMContentLoaded", function() {
                const tagsContainer = document.getElementById("tagsContainer");
                const tagsInput = document.getElementById("tags");

                tagsInput.addEventListener("keydown", function(event) {
                    if (event.key === "Enter" && tagsInput.value.trim() !== "") {
                        const tagName = tagsInput.value.trim();

                        // Make an AJAX request to insert the tag into the database
                        fetch("insert_tag.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded",
                                },
                                body: `tagName=${encodeURIComponent(tagName)}`,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Create a new tag element
                                    const tagElement = document.createElement("div");
                                    tagElement.className = "bg-blue-500 text-white p-1 rounded-md m-1";
                                    tagElement.textContent = tagName;

                                    // Create a button for tag removal
                                    const removeButton = document.createElement("button");
                                    removeButton.className = "ml-1 text-xs";
                                    removeButton.textContent = "Remove";
                                    removeButton.addEventListener("click", function() {
                                        // Make an AJAX request to remove the tag from the database
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
            });
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>

</html>