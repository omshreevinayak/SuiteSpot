<?php
require ('../admin/common/essential.php');
require ('../admin/common/dbConfig.php');
adminLogin();
session_regenerate_id(true);

if (isset($_GET['seen'])) {
    $frm_data = filtration($_GET);
    if ($frm_data['seen'] == 'all') {

    } else {
        $q = "UPDATE `user_quries` SET `seen`=? WHERE `id`=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
        } else {
        }
    }
}

if (isset($_GET['del'])) {
    $frm_data = filtration($_GET);
    if ($frm_data['del'] == 'all') {

    } else {
        $q = "DELETE FROM `user_quries` WHERE `id`=?";
        $values = [$frm_data['del']];
        if (delete($q, $values, 'i')) {
        } else {
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Query</title>
    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <?php require ('../admin/common/links.php'); ?>
    <style>
    * {
        font-family: "Tilt Neon", sans-serif;
    }

    .h-font {
        font-family: "Merienda", cursive;
    }

    .fa-solid {
        margin-right: 10px;
        margin-top: 6px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    /* input[type=number] {
        -moz-appearance: textfield;
    } */

    body {
        font-family: "Merienda", cursive;
        font-size: 0.875rem;
        opacity: 1;
        overflow-y: scroll;
        margin: 0;
    }

    a {
        cursor: pointer;
        text-decoration: none;

    }

    li {
        list-style: none;
    }

    h4 {
        /* font-family: "Merienda", cursive; */
        font-size: 1.275rem;
        color: var(--bs-emphasis-color);
    }

    #loading {
        position: fixed;
        width: 100%;
        height: 100vh;
        background: #fff;
        z-index: 99999;
    }

    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 10;
        width: 160px;
        height: 100px;
        margin-left: -80px;
        margin-top: -50px;
        border-radius: 5px;
        background: #1e3f57;
        animation: dot1_ 3s cubic-bezier(0.55, 0.3, 0.24, 0.99) infinite;
    }

    .loader:nth-child(2) {
        z-index: 11;
        width: 150px;
        height: 90px;
        margin-top: -45px;
        margin-left: -75px;
        border-radius: 3px;
        background: #3c517d;
        animation-name: dot2_;
    }

    .loader:nth-child(3) {
        z-index: 12;
        width: 40px;
        height: 20px;
        margin-top: 50px;
        margin-left: -20px;
        border-radius: 0 0 5px 5px;
        background: #6bb2cd;
        animation-name: dot3_;
    }

    @keyframes dot1_ {

        3%,
        97% {
            width: 160px;
            height: 100px;
            margin-top: -50px;
            margin-left: -80px;
        }

        30%,
        36% {
            width: 80px;
            height: 120px;
            margin-top: -60px;
            margin-left: -40px;
        }

        63%,
        69% {
            width: 40px;
            height: 80px;
            margin-top: -40px;
            margin-left: -20px;
        }
    }

    @keyframes dot2_ {

        3%,
        97% {
            height: 90px;
            width: 150px;
            margin-left: -75px;
            margin-top: -45px;
        }

        30%,
        36% {
            width: 70px;
            height: 96px;
            margin-left: -35px;
            margin-top: -48px;
        }

        63%,
        69% {
            width: 32px;
            height: 60px;
            margin-left: -16px;
            margin-top: -30px;
        }
    }

    @keyframes dot3_ {

        3%,
        97% {
            height: 20px;
            width: 40px;
            margin-left: -20px;
            margin-top: 50px;
        }

        30%,
        36% {
            width: 8px;
            height: 8px;
            margin-left: -5px;
            margin-top: 49px;
            border-radius: 8px;
        }

        63%,
        69% {
            width: 16px;
            height: 4px;
            margin-left: -8px;
            margin-top: -37px;
            border-radius: 10px;
        }
    }

    /* Layout for admin dashboard skeleton */

    .wrapper {
        align-items: stretch;
        display: flex;
        width: 100%;
    }

    #sidebar {
        max-width: 264px;
        min-width: 264px;
        background: var(--bs-dark);
        transition: all 0.35s ease-in-out;
    }

    .main {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        min-width: 0;
        overflow: hidden;
        transition: all 0.35s ease-in-out;
        width: 100%;
        background: var(--bs-dark-bg-subtle);
    }

    /* Sidebar Elements Style */

    .sidebar-logo {
        padding: 1.15rem;
    }

    .sidebar-logo a {
        color: #e9ecef;
        font-family: "Merienda", cursive;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .sidebar-nav {
        list-style: none;
        margin-bottom: 0;
        padding-left: 0;
        margin-left: 0;
    }

    .sidebar-header {
        color: #e9ecef;
        font-size: .75rem;
        padding: 1.5rem 1.5rem .375rem;
    }

    a.sidebar-link {
        padding: .625rem 1.625rem;
        color: #e9ecef;
        position: relative;
        display: block;
        font-size: 0.875rem;
    }

    .sidebar-link[data-bs-toggle="collapse"]::after {
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: "";
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.5rem;
        top: 1.4rem;
        transform: rotate(-135deg);
        transition: all .2s ease-out;
    }

    .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
        transform: rotate(45deg);
        transition: all .2s ease-out;
    }

    .avatar {
        height: 40px;
        width: 40px;
    }

    .navbar-expand .navbar-nav {
        margin-left: auto;
    }

    .content {
        flex: 1;
        max-width: 100vw;
        width: 100vw;
    }

    .navbar {
        background: url(../images/carousel/bg-1.jpg) no-repeat;
        background-size: cover;
        background-position: center;
        height: 30vh;

    }

    @media (min-width:768px) {
        .content {
            max-width: auto;
            width: auto;
        }
    }

    .card {
        box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);
        margin-bottom: 24px;
    }

    .illustration {
        background-color: var(--bs-primary-bg-subtle);
        color: var(--bs-emphasis-color);
    }

    .illustration-img {
        max-width: 150px;
        width: 100%;
    }

    .form-switch input {
        cursor: pointer;
    }

    /* Sidebar Toggle */

    #sidebar.collapsed {
        margin-left: -264px;
    }

    /* Footer and Nav */

    @media (max-width:767.98px) {

        .js-sidebar {
            margin-left: -264px;
        }

        #sidebar.collapsed {
            margin-left: 0;
        }

        .navbar,
        footer {
            width: 100vw;
        }
    }

    /* Theme Toggler */

    .theme-toggle {
        position: fixed;
        top: 50%;
        transform: translateY(-65%);
        text-align: center;
        z-index: 10;
        right: 0;
        left: auto;
        border: none;
        background-color: var(--bs-body-color);
    }

    html[data-bs-theme="dark"] .theme-toggle .fa-sun,
    html[data-bs-theme="light"] .theme-toggle .fa-moon {
        cursor: pointer;
        padding: 10px;
        display: block;
        font-size: 1.25rem;
        color: #FFF;
    }

    html[data-bs-theme="dark"] .theme-toggle .fa-moon {
        display: none;
    }

    html[data-bs-theme="light"] .theme-toggle .fa-sun {
        display: none;
    }
    </style>

</head>

<body onload="myFunction()">
    <!-- <div id="loading">
        <div class="loader"></div>
        <div class="loader"></div>
        <div class="loader"></div>
    </div> -->

    <div class="wrapper">
        <?php require ('../admin/common/header.php'); ?>
        <div class="main">
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>User Query</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Vinayak's Hotel</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1" id="quoteContainer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Query -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                User Query
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">E-mail</th>
                                            <th scope="col" width="10%">Subject</th>
                                            <th scope="col" width="60%">Message</th>
                                            <th scope="col">Date / Time</th>
                                            <th scope="col">Seen</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $q = "SELECT * FROM `user_quries` ORDER BY `id` DESC";
                                        $data = mysqli_query($con, $q);
                                        $i = 1;

                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $seen = '';
                                            $del = '';
                                            if ($row['seen'] != 1) {
                                                $seen = "<a href='?seen=$row[id]' class='primary'><i class='fa-solid fa-square-check'></i></a>";
                                            } elseif ($row['del'] = 1) {
                                                $del = "<a href='?del=$row[id]' class= 'text-danger'><i class='fa-solid fa-trash-can'></i></a>";
                                            }
                                            echo <<<HTML
                                            <tr>
                                                <td>{$i}</td>
                                                <td>{$row['name']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['subject']}</td>
                                                <td>{$row['message']}</td>
                                                <td>{$row['date']}</td>
                                                <td>{$seen}</td>
                                                <td class="text-center">{$del}</td>
                                            </tr>
                                            HTML;
                                            $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- User Query -->
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function myFunction() {
    document.getElementById("loading").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function() {
    async function fetchRandomQuote() {
        try {
            const response = await fetch('https://api.quotable.io/random?tags=business');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return `${data.content} – ${data.author}`;
        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
            return "Sorry, we couldn't retrieve a quote at this moment.";
        }
    }

    const quoteContainer = document.getElementById("quoteContainer");

    fetchRandomQuote().then(quote => {
        quoteContainer.textContent = quote;
    });
});

const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.querySelector(".theme-toggle").addEventListener("click", () => {
    toggleLocalStorage();
    toggleRootClass();
});

function toggleRootClass() {
    const current = document.documentElement.getAttribute('data-bs-theme');
    const inverted = current == 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme', inverted);
}

function toggleLocalStorage() {
    if (isLight()) {
        localStorage.removeItem("light");
    } else {
        localStorage.setItem("light", "set");
    }
}

function isLight() {
    return localStorage.getItem("light");
}

if (isLight()) {
    toggleRootClass();
}
</script>

</html>