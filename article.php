<?php
session_start();
include("connection.php");
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

<body>
    <a href="dashboardUser.php" class="fixed w-8 top-10 left-10">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="56" height="56" viewBox="0 0 256 256" xml:space="preserve">

            <defs>
            </defs>
            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                <path d="M 45 90 c 24.853 0 45 -20.147 45 -45 C 90 20.147 69.853 0 45 0 S 0 20.147 0 45 C 0 69.853 20.147 90 45 90 z M 21.459 43.791 l 18.366 -18.366 c 0.668 -0.668 1.75 -0.668 2.418 0 l 6.055 6.055 c 0.668 0.668 0.668 1.751 0 2.418 l -5.111 5.11 l 24.144 0 c 0.944 0 1.71 0.766 1.71 1.71 v 8.563 c 0 0.944 -0.766 1.71 -1.71 1.71 l -24.145 0 l 5.111 5.111 c 0.668 0.668 0.668 1.751 0 2.418 l -6.055 6.055 c -0.668 0.668 -1.751 0.668 -2.418 0 L 21.459 46.209 C 20.791 45.541 20.791 44.458 21.459 43.791 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(91,160,208); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            </g>
        </svg>
    </a>
    <?php
    $questionId = $_GET['id'];
    $query = "SELECT q.tittre AS title, q.description AS question_description, q.datecreation, u.image AS user_image, u.firstName AS user_firstName, u.lastName AS user_lastName
        FROM question q
        JOIN users u ON q.ID_User = u.id_user
        WHERE q.id_question = $questionId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result)
    ?>
        <div class="w-[80%] mx-auto">
            <div class="w-full bg-white rounded p-4 border border-t-0 border-gray-500">
                <div class="flex flex-row">
                    <div class="flex flex-col text-center w-1/6 pr-4 border-gray-500">
                        <img src="<?= $row['user_image'] ?>" alt="" class="rounded">
                        <p class="font-bold text-blue-500 pt-2"><?= $row['user_firstName'] ?> <?= $row['user_lastName'] ?></p>
                        <p class="text-gray-500 text-sm"><i class="fa-solid fa-user mr-2"></i>User</p>
                    </div>
                    <div class="flex flex-col ml-2 w-5/6 justify-between">
                        <p class="text-sm text-blue-700 mb-2"><?= $row['datecreation'] ?></p>
                        <div class="p-4 bg-gray-100 grow">
                            <p class="font-bold text-2xl"><?= $row['title'] ?></p>
                            <p class="text-md"><?= $row['question_description'] ?></p>
                        </div>
                        <div class="flex flex-row gap-5 self-end">
                            <p class="text-pink-700"><i class="fa-solid fa-heart mr-2"></i>0</p>
                            <p class="text-blue-900"><i class="fa-solid fa-heart-crack mr-2"></i>0</p>
                        </div>
                        <div class="bg-white py-8">
                            <div class="mx-auto px-6">

                                <div class="flow-root">
                                    <ul role="list" class="list-none -mb-8">

                                        <li class="list-none">
                                            <div class="relative pb-8">

                                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                <div class="relative flex flex-col items-start space-x-3">
                                                    <div class="flex gap-4">


                                                        <img class="h-10 w-10 rounded-full bg-gray-400  ring-8 ring-white" src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=8&amp;w=256&amp;h=256&amp;q=80" alt="">

                                                        <div>
                                                            <div class="text-sm">
                                                                <a href="#" class="font-medium text-gray-900">Eduardo Benz</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                Commented 6d ago
                                                            </p>
                                                        </div>


                                                    </div>
                                                </div>


                                                <div class="min-w-0 flex-1">

                                                    <div class="mt-2 ml-8 text-sm text-gray-700">
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt nunc ipsum tempor purus vitae id. Morbi in vestibulum nec varius. Et diam cursus quis sed purus nam.
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>

                                </div>
                                </li>

                                <li class="list-none">

                                    <div class="relative pb-8">



                                        <div class="p-8 bg-white h-[415px] w-full mx-auto">


                                            <form action="#" class="relative">
                                                <div class="pt-5 pl-6 border border-gray-300 rounded-lg shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">

                                                    <textarea rows="2" name="description" id="description" class="block w-full border-none py-0 resize-none placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..."></textarea>

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
                                                        <img x-show="!(assigned.value === null)" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80" :src="assigned.avatar" alt="" class="flex-shrink-0 h-10 w-10 rounded-full" x-description="Selected user avatar, show/hide based on listbox state.">


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
                                </li>
                            </div>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>