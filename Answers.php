<?php
session_start();
 include('connection.php');
 $questionId = isset($_GET['question_id']) ? $_GET['question_id'] : null;
        
        $sql = "SELECT q.id_question AS id_question , q.tittre, q.description AS q_description, q.datecreation AS q_datecreation,
                       uq.image AS questioner_image, uq.firstName AS questioner_firstName, uq.lastName AS questioner_lastName,
                       a.id_reponse, a.reponse, a.datecreation AS a_datecreation,
                       ua.image AS answerer_image, ua.firstName AS answerer_firstName, ua.lastName AS answerer_lastName , ua.role AS role
                FROM question q
                LEFT JOIN reponse a ON q.id_question = a.id_qst
                LEFT JOIN users uq ON q.ID_User = uq.id_user
                LEFT JOIN users ua ON a.user_id_reponse = ua.id_user
                WHERE q.id_question = '$questionId' ";

        $result = $conn->query($sql);

        if ($result) {
            $questionData = $result->fetch_assoc();
        }
        $quetionID=$questionData['id_question'];
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


 
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a class="text-white text-3xl font-semibold uppercase hover:text-gray-300"><img src="./img/white3.png" alt=""></a>
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
            <a   href="dashboardUser.php"  class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item cursor-pointer" id="QuestionsBtn">
                <i class="fa-solid fa-circle-question mr-3"></i>
                Questions
            </a>
        </nav>
        <a href="logout.php" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Sign Out
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen">
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
                    <a href="logout.php" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
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

        <main class="w-full flex flex-col p-6 overflow-y-auto" id="SectionTable">
            <div class="w-full bg-white rounded p-4 border-t border-gray-500">
                <div class="flex flex-row">
                    <!-- User who asked the question -->
                    <div class="flex flex-col text-center w-1/6 pr-4 border-gray-500">
                        <img src="<?= $questionData['questioner_image'] ?>" alt="" class="rounded">
                        <p class="font-bold text-blue-500 pt-2"><?= $questionData['questioner_firstName'] ?> <?= $questionData['questioner_lastName'] ?></p>
                        <p class="text-gray-500 text-sm"><i class="fa-solid fa-user mr-2"><?= $questionData['role'] ?></i></p>
                    </div>
                    <!-- Question details -->
                    <div class="flex flex-col ml-2 w-5/6 justify-between">
                        <p class="text-sm text-blue-700 mb-2"><?= $questionData['q_datecreation'] ?></p>
                        <div class="p-4 bg-gray-100 grow">
                            <p class="font-bold text-2xl"><?= $questionData['tittre'] ?></p>
                            <p class="text-md"><?= $questionData['q_description'] ?></p>

                        </div>
                        <div class="flex flex-row gap-5 self-end">
                        <!-- Like an dislike question  -->
                        <form action="handle_reactionQ.php" method="post"> 
                            <input type="hidden" name="action" value="like">
                            <input type="hidden" name="questionId" value="<?= $questionData['id_question'] ?>">
                            <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                               <i class="fa-solid fa-thumbs-up"></i> 
                                   </button>
                                  <?php
                                                                        // Display the number of likes for this answer
                                    $likesQuery = "SELECT COUNT(*) AS likeCount FROM `reaction` WHERE `id_question` = {$questionData['id_question']} AND `reaction` = 1";
                                    $likesResult = $conn->query($likesQuery);
                                    $likeCount = ($likesResult && $likesResult->num_rows > 0) ? $likesResult->fetch_assoc()['likeCount'] : 0;
                                    ?>
                                    <span class="text-blue-500"><?= $likeCount ?> Likes</span>
                        </form>

                        <form action="handle_reactionQ.php" method="post">
                        <input type="hidden" name="action" value="dislike">
                        <input type="hidden" name="questionId" value="<?= $questionData['id_question'] ?>">
                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                        <i class="fa-solid fa-thumbs-down"></i> 
                        </button>
                        <?php
                        $dislikesQuery = "SELECT COUNT(*) AS dislikeCount FROM `reaction` WHERE `id_question` = {$questionData['id_question']} AND `reaction` = 0";
                        $dislikesResult = $conn->query($dislikesQuery);
                        $dislikeCount = ($dislikesResult && $dislikesResult->num_rows > 0) ? $dislikesResult->fetch_assoc()['dislikeCount'] : 0;
                        ?>
                        <span class="text-red-500"><?= $dislikeCount ?> Dislikes</span>                                                                
                        </form>
                        </div>
                        <div class="bg-white py-8">
                            <div class="mx-auto">

                                <div class="flow-root">


                                    <!-- HTML code for displaying answers -->
                                    <ul role="list" class="list-none -mb-8">

                                        <?php
                                        do {
                                            if ($questionData['id_reponse']) {
                                        ?>
                                                <li class="list-none">
                                                    <div class="relative pb-8">
                                                        <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                        <div class="relative flex flex-col items-start space-x-3">
                                                            <div class="flex gap-4">
                                                                <img class="h-10 w-10 rounded-full bg-gray-400  ring-8 ring-white" src="<?= $questionData['answerer_image'] ?>" alt="">
                                                                <div>
                                                                    <div class="text-sm">
                                                                        <a href="#" class="font-medium text-gray-900"><?= $questionData['answerer_firstName'] ?> <?= $questionData['answerer_lastName'] ?></a>
                                                                    </div>
                                                                    <p class="mt-0.5 text-sm text-gray-500">
                                                                        Commented On : <?= $questionData['a_datecreation']?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Answer details -->
                                                        <div class="min-w-0 flex-1 border-b">
                                                                <div class="mt-2 ml-8 text-sm text-gray-700">
                                                                    <p class=" border-gray-200"><?= $questionData['reponse'] ?></p>
                                                                </div>
                                                                <div class="flex mt-2 ml-8 space-x-4">
                                                                    <form action="handle_reaction.php" method="post"> 
                                                                        <input type="hidden" name="action" value="like">
                                                                        <input type="hidden" name="answerId" value="<?= $questionData['id_reponse'] ?>">
                                                                        <label for="correctAnswer<?= $questionData['id_reponse'] ?>"></label>
                                                                        <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                                                            <i class="fa-solid fa-thumbs-up"></i> 
                                                                        </button>
                                                                        <?php
                                                                        // Display the number of likes for this answer
                                                                        $likesQuery = "SELECT COUNT(*) AS likeCount FROM `reaction` WHERE `id_reponse` = {$questionData['id_reponse']} AND `reaction` = 1";
                                                                        $likesResult = $conn->query($likesQuery);
                                                                        $likeCount = ($likesResult && $likesResult->num_rows > 0) ? $likesResult->fetch_assoc()['likeCount'] : 0;
                                                                        ?>
                                                                        <span class="text-blue-500"><?= $likeCount ?> Likes</span>
                                                                    </form>

                                                                    <form action="handle_reaction.php" method="post">
                                                                        <input type="hidden" name="action" value="dislike">
                                                                        <input type="hidden" name="answerId" value="<?= $questionData['id_reponse'] ?>">
                                                                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                                                                            <i class="fa-solid fa-thumbs-down"></i> 
                                                                        </button>
                                                                        <?php
                                                                        $dislikesQuery = "SELECT COUNT(*) AS dislikeCount FROM `reaction` WHERE `id_reponse` = {$questionData['id_reponse']} AND `reaction` = 0";
                                                                        $dislikesResult = $conn->query($dislikesQuery);
                                                                        $dislikeCount = ($dislikesResult && $dislikesResult->num_rows > 0) ? $dislikesResult->fetch_assoc()['dislikeCount'] : 0;
                                                                        ?>
                                                                        <span class="text-red-500"><?= $dislikeCount ?> Dislikes</span>                                                                
                                                                    </form>
                                                                    <input type="checkbox" id="correctAnswer<?= $questionData['id_reponse'] ?>" name="correctAnswer" value="1">
                                                                            Mark as Correct
                                                                </div>
                                                            </div>
                                                        </div>
                                                </li>
                                        <?php
                                            }
                                        } while ($questionData = $result->fetch_assoc());
                                        ?>
                                    </ul>
                                    <div class="relative pb-8">
                                                <div class="p-8 bg-white h-[415px] w-full mx-auto">


                                                    <form action="Ajouter_reponse.php" method="post" class="relative">
                                                        <div class="pt-5 pl-6 border border-gray-300 rounded-lg shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                                            <input class="hidden" type="text" name="selectedId" value="<?=$_SESSION['id']?>">
                                                            <input class="hidden" type="text" name="questionId" value="<?=$quetionID?>">
                                                            <textarea rows="2" name="description" id="description" class="block w-full border-none py-0 resize-none placeholder-gray-500 focus:ring-0 focus:border-indigo-500 sm:text-sm focus:outline-none" placeholder="Write a description..." required></textarea>
                                                            <div aria-hidden="true">
                                                                <div class="py-2">
                                                                    <div class="h-9"></div>
                                                                </div>
                                                                <div class="h-px"></div>
                                                                <div class="py-2">
                                                                    <div class="py-px">
                                                                        <div class="h-9"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="absolute bottom-0 inset-x-px">

                                                            <div class="border-t border-gray-200 px-2 py-2 flex justify-between items-center space-x-3 sm:px-3">
                                                                <?php if (isset($questionData['id_reponse']) && isset($questionData['answerer_image'])) { ?>
                                                                    <img src="<?= $questionData['answerer_image'] ?>" alt="" class="flex-shrink-0 h-10 w-10 rounded-full">
                                                                <?php } ?>

                                                                <div class="flex-shrink-0">
                                                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                                        post
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
        
</body>
</html>