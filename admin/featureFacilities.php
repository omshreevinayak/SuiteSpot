<?php
require ('../admin/common/essential.php');
adminLogin();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features & Facilities</title>
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
                        <h4>Features & Facilities</h4>
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

                    <!-- Features & Facilities -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                Update Features
                            </h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal"
                                data-bs-target="#features_modal">
                                <i class="fa-solid fa-wand-magic-sparkles"></i>Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table class="table table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>features Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="features_table_body">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="features_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form id="features_form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title GeneralSettings fs-5" id="exampleModalLabel">
                                            Update Features Images
                                        </h1>
                                        <button type="reset" class="btn-close shadow-none text-dark"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-lg-12">
                                            <div class="mb-1">
                                                <label class="form-label">Name :</label>
                                                <input type="text" name="features_name"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="clicker">
                                            <button type="reset" class="btn btn-dark shadow-none"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-white shadow-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- modal -->
                    <!-- Features -->

                    <!-- Facilities -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Update Facilities</h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal"
                                data-bs-target="#facilities_modal">
                                <i class="fa-solid fa-concierge-bell"></i>Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="table table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Facilities Name</th>
                                            <th>Facilities Icon</th>
                                            <th width="60%">Facilities Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="facilities_table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="facilities_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form id="facilities_form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Facilities</h1>
                                        <button type="button" class="btn-close shadow-none text-dark"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-lg-12">
                                            <div class="mb-1">
                                                <label class="form-label">Name :</label>
                                                <input type="text" name="facilities_name" id="facilities_name_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label">Facilities Icon :</label>
                                                <input type="file" name="facilities_image" id="facilities_image_inp"
                                                    accept=".jpg, .png, .webp, .jpeg, .heic, .svg"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label">Description :</label>
                                                <textarea name="facilities_description" id="facilities_description_inp"
                                                    rows="3"
                                                    class="form-control shadow-none border-secondary"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark shadow-none"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-white shadow-none">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- modal -->
                    <!-- Facilities -->
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

    document.addEventListener("DOMContentLoaded", function () {
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
    sidebarToggle.addEventListener("click", function () {
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



    document.getElementById('features_form').addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        formData.append('action', 'upload_features');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/ajax/features_cred.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    let response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                        document.getElementById('features_form').reset();
                        document.getElementById('features_modal').querySelector('.btn-close').click();
                        get_features();
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
                        text: 'Unexpected error occurred',
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to submit the form',
                });
            }
        };

        xhr.send(formData);
    });



    function get_features() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/ajax/features_cred.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('features_table_body').innerHTML = this.responseText;
            } else {
                console.error('Failed to fetch features data');
            }
        }
        xhr.send('get_features');
    }

    function remove_features(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../admin/ajax/features_cred.php", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.responseText == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'The features could not be removed.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'The features has been removed successfully.',
                        });
                        get_features();
                    }
                };
                xhr.send('remove_features=' + id);
            }
        });
    }

    //-------------- facilities 👇👇 --------------//

    document.getElementById('facilities_form').addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData();
        formData.append('facilities_name', facilities_form.elements['facilities_name'].value);
        formData.append('facilities_image', facilities_form.elements['facilities_image'].files[0]);
        formData.append('facilities_description', facilities_form.elements['facilities_description'].value);
        formData.append('action', 'upload_facilities');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/ajax/facilities_cred.php', true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    let response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                        document.getElementById('facilities_form').reset();
                        document.getElementById('facilities_modal').querySelector('.btn-close').click();
                        get_facilities();
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
                        text: 'An error occurred. Please try again.',
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                });
            }
        };

        xhr.send(formData);
    });

    function get_facilities() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/ajax/facilities_cred.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            document.getElementById('facilities_table_body').innerHTML = this.responseText;
        };
        xhr.send('get_facilities=1');
    }

    function remove_facilities(val) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../admin/ajax/facilities_cred.php", true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.responseText == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'The facility could not be removed.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'The facility has been removed successfully.',
                        });
                        get_facilities();
                    }
                };
                xhr.onerror = function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred. Please try again.',
                    });
                };
                xhr.send('remove_facilities=' + val);
            }
        });
    }

    window.onload = function () {
        get_features();
        get_facilities();
    }
</script>

</html>