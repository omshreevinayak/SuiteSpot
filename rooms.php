<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinayak's Hotel - Rooms</title>
    <link rel="shortcut icon" href="../hotel/images/reception-bell.png" type="image/x-icon">

    <?php require('../hotel/common/links.php'); ?>

    <style>
        .h-line {
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
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

        .photu {
            height: 100%;
            width: 100%;
            overflow: hidden;
            flex-shrink: 0;
            border-radius: 20px;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.2);
        }

        .room_card {
            height: auto;
            width: 100%;
            max-width: 850px;
            margin: auto;
            background-color: #ffffff;
            box-shadow: 10px 0 50px rgba(0, 0, 0, 0.5);
        }

        /* .room_items {
        margin-top: .75rem;
    } */

        /* for mobile */
        @media (max-width:426px) {
            .price {
                margin-top: 2rem;
            }
        }
    </style>


</head>

<body onload="myFunction()">
    <!-- <div id="loading">
        <div class="loader"></div>
        <div class="loader"></div>
        <div class="loader"></div>
    </div> -->

    <?php require('../hotel/common/header.php'); ?>



    <!-- Rooms -->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Rooms</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusamus esse, <br>
            blanditiis perferendis quia
            dicta voluptatum impedit dolorum odit eius.
        </p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
                <nav class="navbar navbar-expand-lg bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h2 class="mt-2 filter" href="#">FILTERS</h2>
                        <button class="navbar-toggler 
                        shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="filterDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">

                            <div class="CheckAvailabilities  p-3 rounded mb-3 border-secondary-subtle">
                                <h5 class="mb-3">
                                    Check Availabilities
                                </h5>
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control shadow-none border-secondary-subtle">
                                <label class="form-label mt-3">Check-in</label>
                                <input type="date" class="form-control shadow-none border-secondary-subtle">
                            </div>

                            <div class=" Facilities  p-3 rounded mb-3 border-secondary-subtle">
                                <h5 class="mb-3">
                                    Facilities
                                </h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none border-secondary-subtle me-1">
                                    <label class="form-label" for="f1">Facility - 1</label>
                                </div>

                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none border-secondary-subtle me-1">
                                    <label class="form-label" for="f2">Facility - 2</label>
                                </div>

                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none border-secondary-subtle me-1">
                                    <label class="form-label" for="f3">Facility - 3</label>
                                </div>
                            </div>

                            <div class=" Guests  p-3 rounded 
                            mb-3 border-secondary-subtle">
                                <h5 class="mb-3">
                                    Guests
                                </h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Adults</label>
                                        <input type="number" class="form-control shadow-none border-secondary-subtle">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none border-secondary-subtle">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9 col-md-12 px-4">

                <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `rooms_status`=? AND `removed`=? ORDER BY `id` DESC", [1, 0], 'ii');

                while ($room_data = mysqli_fetch_assoc($room_res)) {
                    // Get room features
                    $fea_q = mysqli_query($con, "SELECT f.features_name FROM `features` f INNER JOIN `room_feature` rfea ON f.id = rfea.features_id WHERE rfea.rooms_id = '{$room_data['id']}'");
                    $room_features = '';
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                        $room_features .= "<span class='badge rounded-pill text-bg-secondary text-wrap me-1 mb-1'>{$fea_row['features_name']}</span>";
                    }

                    // Get room facilities
                    $fac_q = mysqli_query($con, "SELECT f.facilities_name FROM `facilities` f INNER JOIN `room_facility` rfac ON f.id=rfac.facilities_id WHERE rfac.rooms_id ='{$room_data['id']}'");
                    $facilities_data = '';
                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $facilities_data .= "<span class='badge rounded-pill text-bg-secondary text-wrap me-1 mb-1'>
                                    {$fac_row['facilities_name']}
                                </span>";
                    }

                    // Get room default thumbnail
                    $thumb_image = ROOMS_IMAGE_PATH . "../rooms/room-1.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM `rooms_image` WHERE `room_images_id`='{$room_data['id']}' AND `room_images_thumb`='1'");

                    if (!$thumb_q) {
                        // Add error handling if the query fails
                        die("Query failed: " . mysqli_error($con));
                    }

                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_row = mysqli_fetch_assoc($thumb_q);
                        $thumb_image = ROOMS_IMAGE_PATH . $thumb_row['room_images'];
                    }


                    echo <<<html
                        <div class="card mb-3 border-0 shadow room_card">
                        <div class="row g-0 p-3 align-items-center room_items">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <a href="rooms_details.php?id=$room_data[id]" class="shadow-none">
                        <img src="$thumb_image" class="img-fluid rounded photu"
                        alt="Room's Image">
                        </a>
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="mb-3">$room_data[rooms_name]</h5>
                        <div class="features mb-3">
                        <h6 class="mb-1">
                        Features
                        </h6>
                        $room_features
                        </div>
                        <div class="facilities mb-3">
                        <h6 class="mb-1">
                        Facilities
                        </h6>
                        $facilities_data
                        </div>
                        <div class="Guests">
                        <h6 class="mb-1">
                        Guests
                        </h6>
                        <span class="badge rounded-pill text-bg-secondary text-wrap">
                        Adults: $room_data[rooms_guest_adult]
                        </span>
                        <span class="badge rounded-pill text-bg-secondary text-wrap">
                        Children: $room_data[rooms_guest_children]
                        </span>
                        </div>
                        </div>
                        <div class="col-md-2 text-center">
                        <h6 class="price mb-4 fs-5">₹ $room_data[rooms_price] per/night</h6>
                        <a href="#" class="btn w-100 btn-dark shadow-none mb-2">Book Now</a>
                        <a href="rooms_details.php?id=$room_data[id]" class="btn w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                        </div>
                        </div>
                    html;
                }
                ?>

                <!-- <img src="../hotel/images/rooms/logo.svg" class="img-fluid rounded photu"
                    alt="../hotel/images/rooms/logo.svg"> -->

                <!-- <div class="card mb-3 border-0 shadow room_card">
                    <div class="row g-0 p-3 align-items-center room_items">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="../hotel/images/rooms/" class="img-fluid rounded photu"
                                alt="...">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">Room Name</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">
                                    Features
                                </h6>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    2 Rooms
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    1 Bathroom
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    1 Balcony
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    3 Sofa
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">
                                    Facilities
                                </h6>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    <i class="fa-regular fa-snowflake"></i> AC
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    <i class="fa-solid fa-wifi"></i> WIFI
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    <i class="fa-solid fa-tv"></i> TV
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    Room Heater
                                </span>
                            </div>
                            <div class="Guests">
                                <h6 class="mb-1">
                                    Guests
                                </h6>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-secondary text-wrap">
                                    3 Children
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <h6 class="price mb-4 fs-5">₹2000 / Night </h6>
                            <a href="#" class="btn w-100 btn-dark shadow-none mb-2">Book Now</a>
                            <a href="#" class="btn w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Rooms -->







    <?php require('../hotel/common/footer.php'); ?>

    <!-- Swiper JS -->
    <script src=" https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->

</body>
<script>
    var preloader = document.getElementById('loading');

    function myFunction() {
        preloader.style.display = 'none';
    }
</script>

</html>