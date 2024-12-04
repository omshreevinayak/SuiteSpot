<?php
require('../admin/common/essential.php');
require('../admin/common/dbConfig.php');
adminLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert CSS (optional, for custom styling) -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>



    <?php require('../admin/common/links.php'); ?>
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
        <?php require('../admin/common/header.php'); ?>
        <div class="main">
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Rooms</h4>
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

                    <!-- rooms -->
                    <!-- <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Add Rooms</h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal"
                                data-bs-target="#room_modal">
                                <i class="fa-solid fa-plus"></i>Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Room's Name</th>
                                            <th>Room's Area</th>
                                            <th>Room's Guest</th>
                                            <th>Room's Price</th>
                                            <th>Room's Quantity</th>
                                            <th>Room's Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rooms_table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <!- rooms -->

                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Add Rooms</h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal"
                                data-bs-target="#room_modal">
                                <i class="fa-solid fa-plus"></i> Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="table table-hover table-striped table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S/N</th>
                                            <th class="text-center">Room's Name</th>
                                            <th class="text-center">Room's Area</th>
                                            <th class="text-center">No. Of Adults</th>
                                            <th class="text-center">No. Of Children</th>
                                            <th class="text-center">Room's Price</th>
                                            <th class="text-center">Room's Quantity</th>
                                            <th class="text-center">Room's Status</th>
                                            <th class="text-center">Edit Room's Details</th>
                                            <th class="text-center">Edit Room's Image</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rooms_table_body">
                                        <!-- Table content populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="room_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form id="rooms_form" autocomplete="off">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add rooms</h1>
                                        <button type="button" class="btn-close shadow-none text-dark"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label">Room's Name :</label>
                                                <input type="text" name="rooms_name" id="rooms_name_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Area :</label>
                                                <input type="number" min="1" name="rooms_area" id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Guest (Max.Adult) :</label>
                                                <input type="number" min="1" name="rooms_guest_adult"
                                                    id="rooms_guest_adult_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Guest (Max.Children) :</label>
                                                <input type="number" min="1" name="rooms_guest_children"
                                                    id="rooms_guest_children_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Price :</label>
                                                <input type="text" name="rooms_price" id="rooms_price_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Quantity :</label>
                                                <input type="text" name="rooms_quantity" id="rooms_quantity_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-12 mt-2 mb-3">
                                                <label class="form-label fw-bold">Features :</label>
                                                <div class="row">
                                                    <?php
                                                    $res = selectAll('features');
                                                    while ($option = mysqli_fetch_assoc($res)) {
                                                        echo "
                                        <div class='col-md-3'>
                                            <label style='margin-left:2rem;'>
                                                <input type='checkbox' name='features[]' value='{$option['id']}' class='form-check-input shadow-none' style='cursor:pointer;'>
                                                {$option['features_name']}
                                            </label>
                                        </div>
                                    ";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2 mb-3 ">
                                                <label class="form-label fw-bold">Facilities :</label>
                                                <div class="row mb-3 ">
                                                    <?php
                                                    $res = selectAll('facilities');
                                                    while ($option = mysqli_fetch_assoc($res)) {
                                                        echo "
                                        <div class='col-md-3'>
                                            <label style='margin-left:2rem;'>
                                                <input type='checkbox' name='facilities[]' value='{$option['id']}' class='form-check-input shadow-none' style='cursor:pointer;'>
                                                {$option['facilities_name']}
                                            </label>
                                        </div>
                                    ";
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-12 mt-2 mb-3">
                                                    <label class="form-label fw-bold">Room Description :</label>
                                                    <textarea name="room_description" id="rooms_description_inp"
                                                        class="form-control shadow-none border-secondary" rows="4"
                                                        required></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-dark shadow-none"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-white shadow-none">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- modal -->

                    <!-- <!- Modal-> -->
                    <div class="modal fade" id="editRoom_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form id="edit_rooms_form" autocomplete="off">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update rooms</h1>
                                        <button type="button" class="btn-close shadow-none text-dark"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label">Room's Name :</label>
                                                <input type="text" name="rooms_name" id="rooms_name_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Area :</label>
                                                <input type="number" min="1" name="rooms_area" id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Guest (Max.Adult) :</label>
                                                <input type="number" min="1" name="rooms_guest_adult"
                                                    id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Guest (Max.Children) :</label>
                                                <input type="number" min="1" name="rooms_guest_children"
                                                    id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Price :</label>
                                                <input type="text" name="rooms_price" id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-md-6 mt-2 mb-1">
                                                <label class="form-label">Room's Quantity :</label>
                                                <input type="text" name="rooms_quantity" id="rooms_area_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Features :</label>
                                                <div class="row">
                                                    <?php
                                                    $res = selectAll('features');
                                                    while ($option = mysqli_fetch_assoc($res)) {
                                                        echo "
                                        <div class='col-md-3'>
                                            <label style='margin-left:2rem;'>
                                                <input type='checkbox' name='features[]' value='{$option['id']}' class='form-check-input shadow-none' style='cursor:pointer;'>
                                                {$option['features_name']}
                                            </label>
                                        </div>
                                    ";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Facilities :</label>
                                                <div class="row">
                                                    <?php
                                                    $res = selectAll('facilities');
                                                    while ($option = mysqli_fetch_assoc($res)) {
                                                        echo "
                                        <div class='col-md-3'>
                                            <label style='margin-left:2rem;'>
                                                <input type='checkbox' name='facilities[]' value='{$option['id']}' class='form-check-input shadow-none' style='cursor:pointer;'>
                                                {$option['facilities_name']}
                                            </label>
                                        </div>
                                    ";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold">Room Description :</label>
                                                <div class="row">
                                                    <textarea name="room_description" id="room_description_inp"
                                                        class="form-control shadow-none border-secondary" rows="4"
                                                        required></textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" name="room_id" id="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-dark shadow-none"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-white shadow-none">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="room_img_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Room Name</h1>
                                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="add_room_image_form">
                                        <div class="mt-2 mb-1 border-bottom border-3 pb-3 mb-3">
                                            <label class="form-label">Room's Image :</label>
                                            <input type="file" name="room_image"
                                                accept=".jpg, .png, .webp, .jpeg, .heic, image/heic"
                                                class="form-control shadow-none border-secondary" required>
                                            <div class="text-end">
                                                <button type="submit"
                                                    class="btn btn-secondary shadow-none mt-3">Add</button>
                                            </div>
                                            <input type="hidden" name="room_id" id="">
                                        </div>
                                    </form>
                                    <div class="table-responsive-lg">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="60%">Rooms's Image</th>
                                                    <th class="text-center">Thumbnail Image</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody id="rooms_image_table_body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/heic2any@0.5.2/dist/heic2any.min.js"></script>

</body>
<script>
function myFunction() {
    document.getElementById("loading").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function() {
    async function fetchRandomQuote() {
        try {
            const response = await fetch('https://api.quotable.ieirandom?tags=business');
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

document.getElementById('rooms_form').addEventListener('submit', function(event) {
    event.preventDefault();
    add_rooms();
});

function add_rooms() {
    let rooms_form = document.getElementById('rooms_form');
    let data = new FormData(rooms_form);

    data.append('action', 'add_rooms');

    let features = [];
    rooms_form.querySelectorAll('input[name="features[]"]:checked').forEach(el => {
        features.push(el.value);
    });
    data.append('features', JSON.stringify(features));

    let facilities = [];
    rooms_form.querySelectorAll('input[name="facilities[]"]:checked').forEach(el => {
        facilities.push(el.value);
    });
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText.trim() == '1') {
                let myModal = document.getElementById('room_modal');
                let modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Rooms Added Successfully',
                    text: 'The room has been added successfully.',
                }).then(() => {
                    rooms_form.reset();
                    get_all_rooms(); // Refresh the table
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to add the room. Please try again.',
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to communicate with the server. Please try again later.',
            });
        }
    };
    xhr.onerror = function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during the request.',
        });
    };
    xhr.send(data);
}

function get_all_rooms() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('rooms_table_body').innerHTML = this.responseText;
    };
    xhr.send('action=get_all_rooms');
}

function toggleBtn(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        console.log(this.responseText); // Add this line to log the response
        if (this.responseText == 1) {
            Swal.fire({
                icon: 'success',
                // title: 'Rooms Activated Successfully',
                // text: 'The room has been activated successfully.',
            });
            get_all_rooms();
        } else if (this.responseText == 0) {
            get_all_rooms();
        } else {
            // Handle other responses or errors
        }
    };

    xhr.send('toggleBtn=' + id + '&value=' + val);
}

// function edit_room(id) {
//     let xhr = new XMLHttpRequest();

//     xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

//     xhr.onload = function() {
//         if (this.status == 200) {
//             try {
//                 let response = JSON.parse(this.responseText);
//                 console.log(response);

//                 edit_rooms_form.elements['rooms_name'].value = data.roomdata.rooms_name;

//                 if (response) {
//                     // Check and set value for each element
//                     if (document.getElementById('rooms_name')) {
//                         document.getElementById('rooms_name').value = response.rooms_name || '';
//                     }
//                     if (document.getElementById('rooms_area')) {
//                         document.getElementById('rooms_area').value = response.rooms_area || '';
//                     }
//                     if (document.getElementById('rooms_guest_adult')) {
//                         document.getElementById('rooms_guest_adult').value = response.rooms_guest_adult || '';
//                     }
//                     if (document.getElementById('rooms_guest_children')) {
//                         document.getElementById('rooms_guest_children').value = response.rooms_guest_children || '';
//                     }
//                     if (document.getElementById('rooms_price')) {
//                         document.getElementById('rooms_price').value = response.rooms_price || '';
//                     }
//                     if (document.getElementById('rooms_quantity')) {
//                         document.getElementById('rooms_quantity').value = response.rooms_quantity || '';
//                     }
//                     if (document.getElementById('room_description')) {
//                         document.getElementById('room_description').value = response.room_description || '';
//                     }
//                     if (document.getElementById('features')) {
//                         document.getElementById('features').value = response.features.join(', ') || '';
//                     }
//                     if (document.getElementById('facilities')) {
//                         document.getElementById('facilities').value = response.facilities.join(', ') || '';
//                     }
//                 }

//             } catch (e) {
//                 console.error('Error parsing JSON:', e);
//                 console.error('Response:', this.responseText);
//             }
//         } else {
//             console.error('Request failed. Returned status of ' + this.status);
//         }
//     };

//     xhr.onerror = function() {
//         console.error('Request failed');
//     };

//     xhr.send('edit_room=' + encodeURIComponent(id));
// }

document.getElementById('edit_rooms_form').addEventListener('submit', function(event) {
    event.preventDefault();
    add_edited_rooms();
});

function add_edited_rooms() {
    let edit_rooms_form = document.getElementById('edit_rooms_form');
    let data = new FormData(edit_rooms_form);

    data.append('action', 'edit_rooms_form');

    // Collecting checked features
    let features = [];
    edit_rooms_form.querySelectorAll('input[name="features[]"]:checked').forEach(el => {
        features.push(el.value);
    });
    data.append('features', JSON.stringify(features));

    // Collecting checked facilities
    let facilities = [];
    edit_rooms_form.querySelectorAll('input[name="facilities[]"]:checked').forEach(el => {
        facilities.push(el.value);
    });
    data.append('facilities', JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText.trim() == '1') {
                let myModal = document.getElementById('editRoom_modal');
                let modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Rooms Updated Successfully',
                    text: 'The room has been updated successfully.',
                }).then(() => {
                    edit_rooms_form.reset();
                    update_room_in_table(edit_rooms_form.elements['room_id'].value);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update the room. Please try again.',
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to communicate with the server. Please try again later.',
            });
        }
    };
    xhr.onerror = function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during the request.',
        });
    };
    xhr.send(data);
}

function update_room_in_table(room_id) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        let updatedRoom = JSON.parse(this.responseText);
        let row = document.querySelector(`tr[data-room-id="${room_id}"]`);

        if (row) {
            row.innerHTML = `
                <td class='text-center'>${updatedRoom.serial}</td>
                <td class='text-center'>${updatedRoom.rooms_name}</td>
                <td class='text-center'>${updatedRoom.rooms_area} sq/ft</td>
                <td><span class='badge rounded-pills bg-light text-dark'>Adults : ${updatedRoom.rooms_guest_adult}</span></td>
                <td><span class='badge rounded-pills bg-light text-dark'>Children : ${updatedRoom.rooms_guest_children}</span></td>
                <td class='text-center'>₹ ${updatedRoom.rooms_price}</td>
                <td class='text-center'>${updatedRoom.rooms_quantity}</td>
                <td class='text-center'>${updatedRoom.status}</td>
                <td class='text-center'>
                    <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#editRoom_modal' onclick='edit_room(${updatedRoom.id})'><i class='fa-solid fa-file-pen'></i></button>
                </td>
            `;
        }
    };
    xhr.send(`action=get_room_by_id&room_id=${room_id}`);
}

function get_all_rooms() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('rooms_table_body').innerHTML = this.responseText;
    };
    xhr.send('action=get_all_rooms');
}

function edit_room(id) {
    let xhr = new XMLHttpRequest();

    xhr.open('POST', "../admin/ajax/rooms_cred.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.status == 200) {
            try {
                let response = JSON.parse(this.responseText);
                console.log(response); // Check the structure of response in console

                // Update modal form fields with fetched data
                let roomdata = response.roomdata;
                edit_rooms_form.elements['rooms_name'].value = roomdata.rooms_name;
                edit_rooms_form.elements['rooms_area'].value = roomdata.rooms_area;
                edit_rooms_form.elements['rooms_guest_adult'].value = roomdata.rooms_guest_adult;
                edit_rooms_form.elements['rooms_guest_children'].value = roomdata.rooms_guest_children;
                edit_rooms_form.elements['rooms_price'].value = roomdata.rooms_price;
                edit_rooms_form.elements['rooms_quantity'].value = roomdata.rooms_quantity;
                edit_rooms_form.elements['room_description'].value = roomdata.room_description;
                edit_rooms_form.elements['room_id'].value = roomdata.id;

                // Set room_id in room_image_form
                // add_room_image_form.elements['room_id'].value = roomdata.id;

                // Update checkboxes for features
                let features = response.features;
                for (let i = 0; i < features.length; i++) {
                    let featureId = features[i];
                    edit_rooms_form.elements['features[]'].forEach((checkbox) => {
                        if (checkbox.value == featureId) {
                            checkbox.checked = true;
                        }
                    });
                }

                // Update checkboxes for facilities
                let facilities = response.facilities;
                for (let i = 0; i < facilities.length; i++) {
                    let facilityId = facilities[i];
                    edit_rooms_form.elements['facilities[]'].forEach((checkbox) => {
                        if (checkbox.value == facilityId) {
                            checkbox.checked = true;
                        }
                    });
                }

                // Show the modal if it's hidden
                $('#editRoom_modal').modal('show'); // Assuming you're using Bootstrap modal

            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response:', this.responseText);
            }
        } else {
            console.error('Request failed. Returned status of ' + this.status);
        }
    };

    xhr.onerror = function() {
        console.error('Request failed');
    };

    // Send the request with the room ID
    xhr.send('edit_room=' + encodeURIComponent(id));
}

document.getElementById('add_room_image_form').addEventListener('submit', function(e) {
    e.preventDefault();
    add_room_image();
});

document.getElementById('add_room_image_form').addEventListener('submit', function(e) {
    e.preventDefault();
    add_room_image();
});

function add_room_image() {
    let form = document.getElementById('add_room_image_form');
    let formData = new FormData(form);
    formData.append('action', 'upload_room_image'); // Add action field to formData

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../admin/ajax/rooms_image_cred.php', true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                let response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                    form.reset();
                    document.querySelector('#room_img_modal .btn-close').click();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                    });
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response text:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred',
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred',
            });
        }
    };

    xhr.send(formData);
}

function room_image(room_id, room_name) {
    document.getElementById('add_room_image_form').elements['room_id'].value = room_id;
    document.querySelector('#room_img_modal .modal-title').textContent = `Room Name: ${room_name}`;
    console.log("Room ID:", room_id);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../admin/ajax/rooms_image_cred.php', true);

    xhr.onload = function() {
        document.getElementById('rooms_image_table_body').innerHTML = this.responseText;
    }
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('get_rooms_all_image=' + room_id);
}


// function room_image(room_id, room_name) {
//     document.getElementById('add_room_image_form').elements['room_id'].value =
//     room_id; // Ensure this is the correct field name
//     document.querySelector('#room_img_modal .modal-title').textContent = `Room Name: ${room_name}`;
//     console.log("Room ID:", room_id);

//     let xhr = new XMLHttpRequest();
//     xhr.open('POST', '../admin/ajax/rooms_image_cred.php', true);
//     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     xhr.onload = function() {
//         if (xhr.status === 200) {
//             document.getElementById('rooms_image_table_body').innerHTML = xhr.responseText;
//         } else {
//             console.error('Error fetching room images:', xhr.statusText);
//         }
//     };

//     xhr.send('get_rooms_all_image=' + encodeURIComponent(room_id));
// }

function remove_room_image(img_id, room_id) {
    let data = new FormData();
    data.append('rooms_image_id', img_id);
    data.append('room_id', room_id);
    data.append('remove_room_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_image_cred.php", true);

    xhr.onload = function() {
        console.log(this.responseText); // Log the response for debugging

        if (this.responseText.trim() === '1') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Image removal failed!'
            });
            room_image(room_id, document.querySelector("#room-images .modal-title").innerText);
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Image Removed!'
            });
            form.reset();
            document.querySelector('#room_img_modal .btn-close').click();
        }
    };
    xhr.send(data);
}

function thumb_image(img_id, room_id) {
    let data = new FormData();
    data.append('rooms_image_id', img_id);
    data.append('room_id', room_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_image_cred.php", true);

    xhr.onload = function() {
        console.log(this.responseText); // Log the response for debugging

        if (this.responseText.trim() === '1') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Thumbnail set successfully!'
            });
            form.reset();
            document.querySelector('#room_img_modal .btn-close').click();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Setting thumbnail failed!'
            });
        }
    };
    xhr.send(data);
}


window.onload = function() {
    get_all_rooms();
    // get_all_edited_rooms();
    // The functions `edit_room`, `add_room_image`, and `room_image` should be called with actual parameters.
    // Assuming `id`, `room_id`, and `room_name` are defined somewhere in your script.
    // edit_room(id);
    // add_room_image();
    // room_image(room_id, room_name);
}
</script>

</html>