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
    <title>Admin Panel - Settings</title>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

<body>
    <div class="wrapper">
        <?php require ('../admin/common/header.php'); ?>
        <div class="main">
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Carousel Settings</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4>Welcome Back, Admin</h4>
                                            <p class="mb-0">Vinayak's Hotel</p>
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

                    <!-- Carousel -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                Update Carousel Images
                            </h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal"
                                data-bs-target="#carousel-s">
                                <i class="fa-solid fa-user-plus"></i>Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row" id="carousel_data">
                                <div class="col-lg-6">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="carousel-s" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form id="carousel_s_form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title GeneralSettings fs-5" id="exampleModalLabel">
                                            Update Carousel Images
                                        </h1>
                                        <button type="button" class="btn-close shadow-none text-dark"
                                            onclick="carousel_image.value=''" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-lg-12">
                                            <div class="mb-1">
                                                <label class="form-label">Name :</label>
                                                <input type="text" name="carousel_name" id="carousel_name_inp"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label">Profile Image :</label>
                                                <input type="file" name="carousel_image" id="carousel_image_inp"
                                                    accept=".jpg, .png, .webp, .jpeg, .heic"
                                                    class="form-control shadow-none border-secondary" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="clicker">
                                            <button type="button" class="btn btn-dark shadow-none"
                                                onclick="carousel_image.value=''"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-white shadow-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- modal -->
                    <!-- Carousel -->

                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    //--------------------quoteContainer------------------//
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
    //--------------------quoteContainer------------------//

    //--------------------sidebarToggle------------------//
    const sidebarToggle = document.querySelector("#sidebar-toggle");
    sidebarToggle.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
    //--------------------sidebarToggle------------------//

    //--------------------'light' : 'dark'------------------//
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
    //--------------------'light' : 'dark'------------------//

    //--------------------Carousel------------------//
    // let carousel_s_form = document.getElementById('carousel_s_form');
    // document.getElementById('carousel_s_form').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     let formData = new FormData();
    //     formData.append('carousel_image', document.getElementById('carousel_image_inp').files[0]);
    //     formData.append('action', 'upload_carousel_image');

    //     let xhr = new XMLHttpRequest();
    //     xhr.open('POST', '../admin/ajax/carousel_cred.php', true);

    //     xhr.onload = function() {
    //         if (xhr.status === 200) {
    //             try {
    //                 let response = JSON.parse(xhr.responseText);
    //                 if (response.status === 'success') {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Error',
    //                         text: response.message,
    //                     });
    //                     document.getElementById('carousel_s_form').reset();
    //                     document.getElementById('carousel-s').querySelector('.btn-close')
    //                         .click(); // Close modal
    //                     get_carousel_data(); // Refresh team data
    //                 } else {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Error',
    //                         text: response.message,
    //                     });
    //                 }
    //             } catch (e) {
    //                 console.error('Error parsing JSON:', e);
    //                 console.error('Response text:', xhr.responseText);
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Success',
    //                     text: 'Carousel Image added successfully',
    //                 });
    //             }
    //         } else {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: 'Carousel Image added successfully',
    //             });
    //         }
    //     };

    //     xhr.send(formData);
    // });

    // function get_carousel() {
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "../admin/ajax/carousel_cred.php", true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //     xhr.onload = function() {
    //         document.getElementById('carousel_data').innerHTML = this.responseText;
    //         get_carousel();
    //     }
    //     xhr.send('get_carousel');
    // }

    // function remove_carousel(val) {
    //     let xhr = new XMLHttpRequest();
    //     xhr.open("POST", "../admin/ajax/carousel_cred.php", true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //     xhr.onload = function() {
    //         console.log("XHR response status:", this.status); // Debugging line
    //         console.log("XHR response text:", this.responseText); // Debugging line
    //         if (this.responseText == 0) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'The team member havent removed.',
    //             });
    //             get_carousel();
    //         } else {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Success',
    //                 text: 'A team member has been removed successfully',
    //             });
    //         }
    //     };
    //     xhr.onerror = function() {
    //         console.log("XHR error:", this.status); // Debugging line
    //     };
    //     xhr.send('remove_carousel=' + val);
    // }

    // window.onload = function() {
    //     get_carousel();
    // }

    let carousel_s_form = document.getElementById('carousel_s_form');
    document.getElementById('carousel_s_form').addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(carousel_s_form);
        formData.append('action', 'upload_carousel_image');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/ajax/carousel_cred.php', true);

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
                        carousel_s_form.reset();
                        document.querySelector('#carousel-s .btn-close').click();
                        get_carousel();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
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
    });

    function get_carousel() {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/ajax/carousel_cred.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            document.getElementById('carousel_data').innerHTML = this.responseText;
        };
        xhr.send('get_carousel');
    }

    function remove_carousel(val) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../admin/ajax/carousel_cred.php", true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'The carousel image could not be removed.',
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'The carousel image has been removed successfully.',
                });
                get_carousel();
            }
        };
        xhr.send('remove_carousel=' + val);
    }

    window.onload = function() {
        get_carousel();
    };
    </script>
</body>

</html>