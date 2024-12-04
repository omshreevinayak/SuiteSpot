<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinayak's Hotel - About Us</title>
    <link rel="shortcut icon" href="../hotel/images/reception-bell.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <?php require ('../hotel/common/links.php'); ?>

    <style>
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

    .boxx {
        border-radius: 10px;
        cursor: pointer;
    }

    .h-line {
        width: 150px;
        margin: 0 auto;
        height: 1.7px;
    }

    .member-social a {
        color: darkgray;
    }

    .member-social a:hover {
        color: black;
    }

    .advanced-underline {
        position: relative;
        display: inline-block;
    }

    .advanced-underline::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        margin-left: 25%;
        width: 50%;
        bottom: -2px;
        /* Adjust the position */
        height: 2px;
        /* Adjust the thickness */
        background-color: darkgray;
        /* Adjust the color */
    }

    /* for mobile */
    @media (max-width:426px) {}


    .border {
        height: 369px;
        width: 290px;
        background: transparent;
        border-radius: 10px;
        transition: border 1s;
        position: relative;
    }

    .border:hover {
        border: 1px solid #fff;
    }
    </style>


</head>

<body onload="myFunction()">
    <div id="loading">
        <div class="loader"></div>
        <div class="loader"></div>
        <div class="loader"></div>
    </div>

    <?php require ('../hotel/common/header.php'); ?>

    <!-- About Us -->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">About Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusamus esse, <br>
            blanditiis perferendis quia
            dicta voluptatum impedit dolorum odit eius.
        </p>
    </div>
    <!-- About Us -->

    <!-- Cards -->
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-2 order-lg-1 order-md-1">
                <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
                <p>
                    Lorem ipsum dolor sit amet
                    consectetur adipisicing elit.
                    Quod facere debitis dignissimos
                    rem provident voluptate! Laudantium!
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-1 order-lg-2 order-md-2">
                <img src="../hotel/images/about/me.jpg" class="w-100">
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="boxx bg-white rounded shadow p-4 text-center">
                        <img src="../hotel/images/rooms/hotel-solid.svg" alt="" width="70px">
                        <h4 class="mt-3">
                            100+ Rooms
                        </h4>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="boxx bg-white rounded shadow p-4 text-center">
                        <img src="../hotel/images/rooms/users-solid.svg" alt="" width="70px">
                        <h4 class="mt-3">
                            100+ Happy Users
                        </h4>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="boxx bg-white rounded shadow p-4 text-center">
                        <img src="../hotel/images/rooms/customer-service.png" alt="" width="70px">
                        <h4 class="mt-1">
                            24×7 Customer Service
                        </h4>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 px-4">
                    <div class="boxx bg-white rounded shadow p-4 text-center">
                        <img src="../hotel/images/rooms/support.png" alt="" width="70px">
                        <h4 class="mt-3">
                            500+ Reviews
                        </h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Cards -->

    <!-- Our Management Team -->



    <section class="team text-center py-5">
        <div class="container">
            <div class="header my-5">
                <h1>Meet our Team </h1>
                <p class="text-muted advanced-underline">Meet and Greet our Team Members</p>
            </div>
            <div class="row">

                <?php
                $about_r = selectAll('management_details');
                $path = ABOUT_IMG_PATH;
                while ($row = mysqli_fetch_assoc($about_r)) {
                    echo <<<HTML
                    <div class="col-md-6 col-lg-3">
                        <div class="img-block mb-5">
                            <img src="$path$row[image]" class="img-fluid img-thumbnail rounded-circle" alt="{$row['name']}">
                            <div class="content mt-2">
                                <h4>$row[name]</h4>
                                <p class="text-muted">$row[description]</p>
                            </div>
                            <!-- <div class="d-flex justify-content-around member-social">
                                <a href="{$row['member_insta']}" target=_blank>
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="@">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="@">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            </div> -->
                        </div>
                    </div>
                    HTML;
                }
                ?>

            </div>
        </div>
    </section>
    <!-- Our Management Team -->


    <?php require ('../hotel/common/footer.php'); ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var preloader = document.getElementById('loading');

    function myFunction() {
        preloader.style.display = 'none';
    }
    </script>
</body>

</html>