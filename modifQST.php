<?php
// modifQST.php

// Include the database connection file
include 'connection.php';

// Retrieve the question ID from the query parameter
$qst_id = isset($_GET['qst_id']) ? $_GET['qst_id'] : 0;

// Fetch the question details from the database based on the $qst_id
$selectQuestionQuery = "SELECT * FROM question WHERE id_question = $qst_id";
$result = mysqli_query($conn, $selectQuestionQuery);

if (!$result) {
    // Handle the case where the select query fails
    echo "Error fetching question details: " . mysqli_error($conn);
    exit;
}

$questionData = mysqli_fetch_assoc($result);

// Fetch the existing tags associated with the question
$tagsQuery = "SELECT ID_tag FROM tagquetion WHERE ID_question = $qst_id";
$tagsResult = mysqli_query($conn, $tagsQuery);

$existingTags = [];
while ($tagRow = mysqli_fetch_assoc($tagsResult)) {
    $existingTags[] = $tagRow['ID_tag'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Question</title>
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
</head>
<body>
    <h1>Modify Question</h1>

    <form class="w-[70%]" action="update_question.php" method="post">
    <div class="w-[80%] p-12 z-10 mx-[10%] bg-white">

        <!-- Hidden input for question ID -->

        <!-- Modified title input -->
        <div class="relative border border-gray-300 rounded-md px-3 py-2 shadow-sm">
            <label for="updated_title" class="absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium text-gray-900">Title</label>
            <input type="text" name="updated_title" id="updated_title" class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Title" value="<?= htmlspecialchars($questionData['tittre']) ?>" required>
        </div>

        <!-- Hidden input for tag IDs -->
   

        <!-- Tags input -->
        <div class="mt-2 border border-gray-300 rounded-md px-3 relative">
            <label for="tags" class="block text-sm font-medium text-gray-700 absolute -top-2 left-2 -mt-px inline-block px-1 bg-white text-xs font-medium">Tags</label>
            <div id="tagsContainer" class="flex flex-wrap mb-2">
                <?php
                // Display existing tags as pre-filled tags
                
            // Fetch all available tags
            
                   $allTagsQuery = "SELECT tag.tag_name,tag.id_tag FROM tag INNER JOIN tagquetion ON tagquetion.ID_Tag = tag.id_tag where ID_Question = $qst_id ";
                    $allTagsResult = mysqli_query($conn, $allTagsQuery);

                    while ($tagRow = mysqli_fetch_assoc($allTagsResult)) {
                        $tagId = $tagRow['id_tag'];
                        $tagName = $tagRow['tag_name'];
                    
                        // Check if the tag is associated with the question
                        $selected = in_array($tagId, $existingTags) ? 'selected' : '';
                    
                        // Display the tag with a remove button
                        echo '<div id="tag_' . $tagId . '" class="bg-blue-500 text-white p-1 rounded-md m-1">' . $tagName .  '<button class="ml-1 text-xs" onclick="removeTag(' . $tagId . ');">REMOVE</button></div>';
                    }
                
                ?>
            </div>
            <input type="text" id="tags" name="tags" class="mt-1 p-2 w-full border rounded-md" placeholder="Add tags">
        </div>

        <!-- Modified description input -->
        <div class="mt-2">
            <textarea rows="8" name="updated_description" id="updated_description" class="block w-full border-2 border-gray-300 rounded-md py-1 resize-none placeholder-gray-500 focus:ring-0 pl-2 sm:text-sm" placeholder="Write a description..."required><?= htmlspecialchars($questionData['description']) ?></textarea>
        </div>

        <!-- Updated submit button -->
        <button type="submit" class="hover:bg-green-400 p-2 mt-2 text-center text-black text-xs font-medium bg-gray-200 rounded-full" name="submit_question">Update Question</button>

    </div>
</form>
<script>
      function removeTag(tagId) {
        // Remove the tag from the tagsContainer
        var tagElement = document.getElementById('tag_' + tagId);
        tagElement.parentNode.removeChild(tagElement);

        // Remove the tag from the hidden input
        var tagsInput = document.getElementById('tags');
        var currentTags = tagsInput.value.split(',');
        var tagIndex = currentTags.indexOf(tagId.toString());
        if (tagIndex !== -1) {
            currentTags.splice(tagIndex, 1);
            tagsInput.value = currentTags.join(',');
        }
    }
        
</script>
</body>
</html>
