<?php
require('../admin/common/essential.php');
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


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

<body onload="myPreloader()">
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
                        <h4>Admin Settings</h4>
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
                    <!-- general settings -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                General Settings
                            </h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="fa-solid fa-user-pen"></i> Edit
                            </button>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-1 fw-bold">Site Title :</h6>
                            <p class="card-text" id="site_title"></p>
                            <h6 class="card-subtitle mb-1 fw-bold">About Us :</h6>
                            <p class="card-text" id="site_description"></p>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="general-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form id="general_s_form">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title GeneralSettings fs-5" id="exampleModalLabel">
                                            General Settings
                                        </h1>
                                        <button type="button" class="btn-close shadow-none text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <label class="form-label">Site Title :</label>
                                            <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none border-secondary" required>
                                        </div>
                                        <div class="mt-2 mb-1">
                                            <label class="form-label">Site Description :</label>
                                            <textarea name="site_description" id="site_description_inp" class="form-control shadow-none border-secondary" rows="6" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="clicker">
                                            <button type="button" class="btn btn-dark shadow-none" onclick="site_title.value = general_data.site_title, site_description.value = general_data.site_description" data-bs-dismiss="modal">Cancel</button>
                                            <!-- <button type="submit" class="btn btn-outline-dark shadow-none"
                                        id="update_button"
                                        onclick="update_general(site_title.value,site_description.value)">Save</button> -->
                                            <button type="submit" class="btn btn-white shadow-none" onclick="update_general(site_title.value,site_description.value)" id="update_button">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- general settings -->

                    <!-- Shutdown_toggle -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                Shutdown Our Website
                            </h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown-toggle">
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle text-muted">
                                Clicking this button will immediately shut down the entire site. All ongoing sessions
                                will
                                be terminated, and users will be logged out. Use this feature only in case of
                                emergencies or
                                planned maintenance.
                            </h6>
                            <p class="card-text text-danger mt-2">
                                <strong>Important !</strong>
                            </p>
                            <ul>
                                <li style="list-style:lower-alpha;">Ensure you have saved all your work.</li>
                                <li style="list-style:lower-alpha;">Notify all users before initiating the shutdown.
                                </li>
                                <li style="list-style:lower-alpha;">Do not use this feature if you are not sure what you
                                    are doing.</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Shutdown_toggle -->

                    <!-- contact us settings -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                Update Contact Us
                            </h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal" data-bs-target="#contact-us">
                                <i class="fa-solid fa-user-pen"></i> Edit
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">Address :</h6>
                                        <p class="card-text">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span id="hotel_address"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">Google Maps :</h6>
                                        <p class="card-text">
                                            <i class="fa-solid fa-map-location-dot"></i>
                                            <span id="hotel_map"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">Contact Number</h6>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="card-text">
                                                    <i class="fa-solid fa-phone"></i> :
                                                    <span id="contactNumber_1"></span>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="card-text">
                                                    <i class="fa-solid fa-phone"></i> :
                                                    <span id="contactNumber_2"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                                        <p class="card-text">
                                            <i class="fa-solid fa-at"></i> :
                                            <span id="hotel_mail"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                        <div class="row mt-2">
                                            <div class="col-lg-6">
                                                <p class="card-text">
                                                    <i class="fa-brands fa-instagram"></i> :
                                                    <span id="insta_link"></span>
                                                </p>
                                                <p class="card-text">
                                                    <i class="fa-brands fa-facebook"></i> :
                                                    <span id="meta_link"></span>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p class="card-text">
                                                    <i class="fa-brands fa-twitter"></i> :
                                                    <span id="twitter_link"></span>
                                                </p>
                                                <p class="card-text">
                                                    <i class="fa-brands fa-youtube"></i> :
                                                    <span id="youtube_link"></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <h6 class="card-subtitle mb-1 fw-bold">Iframe :</h6>
                                        <Iframe id="iframe_link" loading="lazy" class="w-100 p-2 rounded shadow-none rounded border-secondary-subtle"></Iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade modal-xl" id="contact-us" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form id="contact_us_form">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title contactUS fs-5 text-center" id="exampleModalLabel">
                                            Update Contact Us
                                        </h1>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">

                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Address :</label>
                                                        <input type="text" name="hotel_address" id="hotel_address_inp" class="form-control shadow-none border-secondary" required>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label">Google Maps :</label>
                                                        <input type="text" name="map" id="hotel_map_inp" class="form-control shadow-none border-secondary" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone Numbers :</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </span>
                                                            <input type="number" class="form-control shadow-none border-secondary" placeholder="Please Do Write Country Code." name="pn_1" id="contactNumber_1_inp" required>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </span>
                                                            <input type="number" class="form-control shadow-none border-secondary" placeholder="Please Do Write Country Code." name="pn_2" id="contactNumber_2_inp">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label">G-Mail :</label>
                                                        <input type="text" name="mail" id="hotel_mail_inp" class="form-control shadow-none border-secondary" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Social Links :</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-brands fa-instagram"></i>
                                                            </span>
                                                            <input type="text" class="form-control shadow-none border-secondary" name="instagram" id="insta_link_inp">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-brands fa-facebook"></i>
                                                            </span>
                                                            <input type="text" class="form-control shadow-none border-secondary" name="meta" id="meta_link_inp">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-brands fa-twitter"></i>
                                                            </span>
                                                            <input type="text" class="form-control shadow-none border-secondary" name="twitter" id="twitter_link_inp">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa-brands fa-youtube"></i>
                                                            </span>
                                                            <input type="text" class="form-control shadow-none border-secondary" name="youtube" id="youtube_link_inp">
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 mt-3">
                                                        <label class="form-label">Iframe :</label>
                                                        <input type="text" name="iframe" id="iframe_link_inp" class="form-control shadow-none border-secondary iframe" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="clickerr">
                                            <button type="button" class="btn btn-dark shadow-none" onclick="contact_inp(contact_data)" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-white shadow-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- contact us settings -->

                    <!-- Management Teams -->
                    <div class="card border-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">
                                Management Teams Settings
                            </h5>
                            <button class="btn btn-white shadow-none" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="fa-solid fa-user-plus"></i>Add
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row" id="team_data">
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="team-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form id="team_s_form">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title GeneralSettings fs-5" id="exampleModalLabel">
                                            Update Management Teams
                                        </h1>
                                        <button type="button" class="btn-close shadow-none text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-lg-6">
                                            <div class="mb-1">
                                                <label class="form-label">Name :</label>
                                                <input type="text" name="member_name" id="member_name_inp" class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label">Profile Image :</label>
                                                <input type="file" name="member_image" id="member_image_inp" accept=".jpg, .png, .webp, .jpeg, .heic" class="form-control shadow-none border-secondary" required>
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label">Description :</label>
                                                <input type="text" name="member_description" id="member_description_inp" class="form-control shadow-none border-secondary" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 mb-1">
                                                <label class="form-label"><i class="fa-brands fa-instagram"></i>
                                                    :</label>
                                                <input type="text" name="member_insta" id="member_insta_inp" class="form-control shadow-none border-secondary">
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label"><i class="fa-brands fa-facebook"></i>
                                                    :</label>
                                                <input type="text" name="member_facebook" id="member_facebook_inp" class="form-control shadow-none border-secondary">
                                            </div>
                                            <div class="mt-2 mb-1">
                                                <label class="form-label"><i class="fa-solid fa-at"></i>
                                                    :</label>
                                                <input type="text" name="member_mail" id="member_mail_inp" class="form-control shadow-none border-secondary">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="clicker">
                                            <button type="button" class="btn btn-dark shadow-none" onclick="" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-white shadow-none">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- modal -->
                    <!-- Management Teams -->
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
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

        // ------night mode btn-------

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

        // ------night mode btn-------

        let navBar = document.querySelectorAll('.nav-link');
        let navbarCollapse = document.querySelector('.navbar-collapse .collapse');
        navBar.forEach(function(a) {
            a.addEventListener('click', function() {
                navbarCollapse.classList.remove('show');
            })
        })

        let general_data, contact_data;
        let general_s_form = document.getElementById('general_s_form');
        let contact_us_form = document.getElementById('contact_us_form');
        let team_s_form = document.getElementById('team_s_form');
        let member_name_inp = document.getElementById('member_name_inp');
        let member_description = document.getElementById('member_description');
        let member_description_inp = document.getElementById('member_description_inp');



        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_description = document.getElementById('site_description');

            let site_title_inp = document.getElementById('site_title_inp');
            let site_description_inp = document.getElementById('site_description_inp');

            let shutdown_toggle = document.getElementById('shutdown-toggle');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                general_data = JSON.parse(this.responseText);
                site_title.innerText = general_data.site_title;
                site_description.innerText = general_data.site_description;

                site_title_inp.value = general_data.site_title;
                site_description_inp.value = general_data.site_description;

                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                } else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }
            xhr.send('get_general');
        }

        function update_general(site_title_val, site_description_val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.responseText == 0 && general_data.shutdown == 1) {
                    Swal.fire({
                        title: "success",
                        text: "That thing is still around?",
                        icon: "question"
                    });
                    get_general();
                } else {
                    Swal.fire({
                        title: "The Internet?",
                        text: "That thing is still around?",
                        icon: "question"
                    });
                }
            }
            xhr.send('site_title=' + site_title_val + '&site_description=' + site_description_val + '&update_general');
        }

        function upd_shutdown(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log('Server response:', this.responseText); // Debugging line

                // Trim the response and check for success
                let response = this.responseText.trim();
                if (response === '1') {
                    if (val == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Shutdown Mode Deactivated',
                            text: 'The system has been put into shutdown mode.',
                        });
                    } else if (val == 0) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Shutdown Mode Activated',
                            text: 'The system has been put into shutdown mode.',
                        });
                    }
                    get_general();
                } else {
                    console.error('Failed response:', response); // Log the exact failed response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update shutdown mode.',
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
            xhr.send('upd_shutdown=' + val);
        }

        function get_contact() {
            let contact_p_id = ['hotel_address', 'hotel_map', 'contactNumber_1', 'contactNumber_2', 'hotel_mail',
                'insta_link', 'meta_link', 'twitter_link', 'youtube_link'
            ];
            let iframe = document.getElementById('iframe_link');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                contact_data = JSON.parse(this.responseText);
                contact_data = Object.values(contact_data);
                for (i = 0; i < contact_p_id.length; i++) {
                    document.getElementById(contact_p_id[i]).innerText = contact_data[i + 1];
                }
                iframe.src = contact_data[10];
                contact_inp(contact_data);
            }
            xhr.send('get_contact');
        }

        function contact_inp(modal_vala) {
            let contact_p_id = ['hotel_address_inp', 'hotel_map_inp', 'contactNumber_1_inp', 'contactNumber_2_inp',
                'hotel_mail_inp',
                'insta_link_inp', 'meta_link_inp', 'twitter_link_inp', 'youtube_link_inp', 'iframe_link_inp'
            ];
            for (i = 0; i < contact_p_id.length; i++) {
                document.getElementById(contact_p_id[i]).value = modal_vala[i + 1];
            }
        }

        contact_us_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_contacts();
        })

        function upd_contacts() {
            let index = ['hotel_address', 'hotel_map', 'contactNumber_1', 'contactNumber_2', 'hotel_mail',
                'insta_link', 'meta_link', 'twitter_link', 'youtube_link', 'iframe_link'
            ];
            let contact_inp_id = ['hotel_address_inp', 'hotel_map_inp', 'contactNumber_1_inp', 'contactNumber_2_inp',
                'hotel_mail_inp',
                'insta_link_inp', 'meta_link_inp', 'twitter_link_inp', 'youtube_link_inp', 'iframe_link_inp'
            ];
            let data_str = "";
            for (let i = 0; i < index.length; i++) {
                data_str += index[i] + "=" + encodeURIComponent(document.getElementById(contact_inp_id[i]).value) + '&';
            }
            data_str += "upd_contacts";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    if (this.responseText.trim() == '0') {
                        var myModal = document.getElementById('contact-us');
                        var modal = bootstrap.Modal.getInstance(myModal);
                        modal.hide();
                        Swal.fire({
                            icon: 'success',
                            title: 'Contacts Updated',
                            text: 'Contacts updated successfully!',
                        }).then(() => {
                            // Execute code after success message is closed
                            get_contact();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update contacts.',
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
            xhr.send(data_str);
        }

        document.getElementById('team_s_form').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData();
            formData.append('member_name', document.getElementById('member_name_inp').value);
            formData.append('member_image', document.getElementById('member_image_inp').files[0]);
            formData.append('member_description', document.getElementById('member_description_inp').value);
            formData.append('member_insta', document.getElementById('member_insta_inp').value);
            formData.append('member_facebook', document.getElementById('member_facebook_inp').value);
            formData.append('member_mail', document.getElementById('member_mail_inp').value);
            formData.append('action', 'upload_team_member');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../admin/ajax/settings_cred.php', true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                            });
                            document.getElementById('team_s_form').reset();
                            document.getElementById('team-s').querySelector('.btn-close')
                                .click(); // Close modal
                            get_team_data(); // Refresh team data
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
                            icon: 'success',
                            title: 'Success',
                            text: 'Team member added successfully',
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'A team member added successfully',
                    });
                }
            };

            xhr.send(formData);
        });

        function get_members() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                document.getElementById('team_data').innerHTML = this.responseText;
                get_members();
            }
            xhr.send('get_members');
        }

        // function remove_members(val) {
        //     let xhr = new XMLHttpRequest();
        //     xhr.open("POST", "../admin/ajax/settings_cred.php", true);
        //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //     xhr.onload = function() {
        //         if (this.responseText == 1) {

        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'error',
        //                 text: 'A team member has been removed successfully',
        //             });
        //             get_members();
        //         } else {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Success',
        //                 text: 'A team member has been removed successfully',
        //             });
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Success',
        //                 text: 'A team member has been removed successfully',
        //             });
        //         }
        //     }
        //     xhr.send('remove_members=' + val);
        // }

        // document.addEventListener("DOMContentLoaded", function() {
        //     remove_members();
        // });

        // function remove_members(val) {
        //     console.log("Attempting to remove member with ID:", val); // Debugging output
        //     let xhr = new XMLHttpRequest();
        //     xhr.open("POST", "../admin/ajax/settings_cred.php", true);
        //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //     xhr.onload = function() {
        //         console.log("Response received:", this.responseText); // Debugging output
        //         if (this.responseText == 1) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Success',
        //                 text: 'A team member has been removed successfully',
        //             });
        //             get_members();
        //         } else {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Success',
        //                 text: 'A team member has been removed successfully',
        //             });
        //         }
        //     }
        //     xhr.send('remove_members=' + val);
        // }


        function remove_members(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../admin/ajax/settings_cred.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log("XHR response status:", this.status); // Debugging line
                console.log("XHR response text:", this.responseText); // Debugging line
                if (this.responseText == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'The team member havent removed.',
                    });
                    get_members();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'A team member has been removed successfully',
                    });
                }
            };
            xhr.onerror = function() {
                console.log("XHR error:", this.status); // Debugging line
            };
            xhr.send('remove_members=' + val);
        }




        window.onload = function() {
            get_general();
            get_contact();
            get_members();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
    var preloader = document.getElementById('loading');

    function myPreloader() {
        preloader.style.display = 'none';
    }
</script>

</html>