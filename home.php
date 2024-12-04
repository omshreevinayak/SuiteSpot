<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinayak's Hotel - Home</title>
    <link rel="shortcut icon" href="../hotel/images/reception-bell.png" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <?php require('../hotel/common/links.php'); ?>


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

    a {
        text-decoration: none;
        color: gray;
    }




    .navbar {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(10.5px);
        -webkit-backdrop-filter: blur(10.5px);
        /* border-radius: 10px; */
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .form-control {
        background-color: transparent;
    }

    .availabilities-form {
        z-index: 100;
        margin-top: -2.5rem;
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(7px);
        -webkit-backdrop-filter: blur(7px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .swiperTestimonials .swiper-wrapper {
        width: 100%;
        margin-top: 80px;
        margin-bottom: 80px;
    }

    .swiperTestimonials .swiper-slide {
        background-position: center;
        background-size: cover;
        padding-left: 20px;
    }

    /* .reviews {
        background: url('../HOTEL/images/reviews/World Map.svg');
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;
        background-attachment: fixed;
        position: relative;
    } */

    .slideTestimonials {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    /* .our-facilities {
        background-image: url('../hotel/images/IconGrid.svg');
        background-repeat: no-repeat;
        background-size: 100vw;
        padding-bottom: 3rem;
    } */

    /* for mobile */
    @media (max-width:426px) {

        .navbar-nav {
            align-items: center;
        }

        .login-signup {
            margin-right: 6rem;
        }

        .availabilities {
            margin-top: 8rem;
        }

        .testimonials {
            background: url('../HOTEL/images/reviews/World Map.svg');
            background-repeat: no-repeat;
            background-size: 100vh;
            background-attachment: fixed;
            position: relative;
        }
    }

    /* for laptop */
    @media (min-width:426px) {

        .navbar-nav {
            margin-left: 11rem;
        }

        .reachUs {
            margin-top: 2.25rem;
        }

        /* .contact {
            background: url('../HOTEL/images/reviews/World Map.svg');
            background-repeat: no-repeat;
            background-size: contain;
        } */
    }

    .line {
        width: 10%;
        /* Adjust the width as needed */
        height: 2px;
        /* Adjust the height as needed */
        background-color: black;
        /* Change to your desired color */
        margin: 0 auto;
        /* Center the line */
        position: relative;
        /* Position relative to the heading */
        top: -15px;
        /* Adjust this value to move the line closer to the heading */
    }

    .product {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 240px;
        height: 340px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .25);
        overflow: hidden;
    }

    .imgbox img {
        width: 100%;
        display: block;
        margin: 20px auto 0;
    }

    .product .imgbox {
        height: 100%;
        box-sizing: border-box;
    }

    .details {
        position: absolute;
        width: 100%;
        bottom: -145px;
        background: #fff;
        padding: 10px;
        box-sizing: border-box;
        box-shadow: 0 0 0 rgba(0, 0, 0, 0);
        transition: .5s;
    }

    .details h2 {
        margin: 0;
        padding: 0;
        font-size: 16px;
        width: 100%;
    }

    .details h2 span {
        font-size: 12px;
        color: #ccc;
        font-weight: normal;
    }

    .details .price {
        position: absolute;
        top: 10px;
        right: 20px;
        font-weight: bold;
        font-size: 20px;
    }

    label {
        display: block;
        margin-top: 5px;
        font-weight: bold;
        font-size: 14px;
    }



    /* a {
        display: block;
        padding: 5px;
        color: #fff;
        margin: 15px;
        background: #ff4faf;
        text-align: center;
        text-decoration: none;
        transition: .3s;
    } */

    /* a:hover {
        color: #000;
    } */

    .product:hover .details {
        bottom: 0;
    }





    /* SKELETON */
    .skeleton {
        position: relative;
    }

    .skeleton::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background: linear-gradient(90deg, #eee, #f9f9f9, #eee);
        background-size: 200%;
        animation: skeleton 1s infinite reverse;
    }

    @keyframes skeleton {
        0% {
            background-position: -100% 0;
        }

        100% {
            background-position: 100% 0;
        }
    }

    /* SKELETON */
    </style>
</head>

<body>

    <!-- <div id="loading">
        <div class="loader"></div>
        <div class="loader"></div>
        <div class="loader"></div>
    </div> -->


    <?php require('common/header.php'); ?>

    <!-- Swiper -->

    <div class="container-fluid px-lg-4 m1-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                $res = selectAll('carousel');
                while ($row = mysqli_fetch_assoc($res)) {
                    $path = CAROUSEL_IMAGE_PATH;
                    $imagePath = $path . $row['carousel_img'];
                    echo <<<HTML
                        <div class="swiper-slide">
                            <div class="skeleton skeleton-image"></div>
                            <img src="$imagePath" alt="{$row['carousel_name']}" class="w-100 d-block lazy-load">
                        </div>
                        HTML;
                }
                ?>
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
            </div>
        </div>
    </div>
    <!-- Swiper -->

    <!-- <div class="container-fluid px-lg-4 m1-4 phone">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="../hotel/images/carousel/phone-bg-1.jpg" alt="" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="../hotel/images/carousel/phone-bg-2.jpg" alt="" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="../hotel/images/carousel/phone-bg-3.jpg" alt="" class="w-100 d-block">
                </div>
            </div>
            <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    </div> -->

    <!-- Check Booking Availabilities -->
    <div class="container availabilities">
        <div class="row ">
            <div class="col-lg-12 shadow p-4 rounded availabilities-form loading">
                <h5 class="mb-4 text-center">Check Booking Availabilities</h5>
                <!-- <div class="skeleton skeleton-form"></div> -->
                <form action="@" class="">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-in</label>
                            <input type="date" class="form-control shadow-none border-secondary" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-out</label>
                            <input type="date" class="form-control shadow-none border-secondary" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Adults</label>
                            <select class="form-select form-control shadow-none border-secondary">
                                <option class="form-control" value="0">0</option>
                                <option class="form-control" value="1">1</option>
                                <option class="form-control" value="2">2</option>
                                <option class="form-control" value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label " style="font-weight:500;">Children</label>
                            <select class="form-select form-control shadow-none border-secondary">
                                <option class="form-control" value="0">0</option>
                                <option class="form-control" value="1">1</option>
                                <option class="form-control" value="2">2</option>
                                <option class="form-control" value="3">3</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2 availabilities-btn">
                            <button type="submit" class="btn btn-dark shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Check Booking Availabilities -->

    <!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Rooms</h2>
    <div class="line"></div>
    <div class="container">
        <div class="row">


            <?php
            $room_res = select("SELECT * FROM `rooms` WHERE `rooms_status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');

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
                    <div class="col-lg-12 col-md-6 col-sm-12 mb-4">
                    <div class="card mb-3 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="$thumb_image" class="img-fluid rounded photu"
                        alt="Room's Image">
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
                        <div class="col-md-2 mt-2 text-center">
                        <h6 class="price mb-4 fs-5">₹ $room_data[rooms_price] per/night</h6>
                        <a href="#" class="btn w-100 btn-dark shadow-none mb-2">Book Now</a>
                        <a href="rooms_details.php?id=$room_data[id]" class="btn w-100 btn-outline-dark shadow-none">More Details</a>
                        </div>
                        </div>
                        </div>
                    </div>
                    html;
            }
            ?>

            <!-- <div class="product">
                <div class="imgbox">
                <img src="$thumb_image" class="img-fluid rounded photu"
                alt="Room's Image">
                </div>
                <div class="details">
                    <h2>$room_data[rooms_name]</h2>
                    <div class="price">₹ $room_data[rooms_price] per/night</div>
                    <a href="rooms_details.php?id=$room_data[id]" class="btn w-100 btn-outline-dark shadow-none">More Details</a>
                </div>
            </div> -->


            <!-- <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                    <img src="../hotel/images/rooms/room-1.jpg" class="card-img-top" alt="Room">
                    <div class="card-body">
                        <h5 class="card-title">Room Name</h5>
                        <h6 class="price mb-4">₹2000 / Night </h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
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
                        <div class="adults mb-4">
                            <h6 class="mb-1">
                                Adults
                            </h6>
                            <span class="badge rounded-pill text-bg-secondary text-wrap">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill text-bg-secondary text-wrap">
                                3 Children
                            </span>
                        </div>
                        <div class="ratings mb-4">
                            <h6 class="mb-1">
                                Ratings
                            </h6>
                            <span class="badge rounded-pill">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-dark shadow-none">Book Now</a>
                            <a href="#" class="btn btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-lg-12 text-center mt-5">
                <a href="../hotel/rooms.php" class="btn btn-sm btn-outline-dark round-0 fw-bold shadow-none">
                    More Room <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Our Rooms -->

    <!-- Our Facilities -->
    <div class="our-facilities">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>
        <div class="line"></div>
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 px-lg-0 px-5">

                <?php
                $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY id DESC LIMIT 5 ");
                $path = Facilities_IMAGE_PATH;
                while ($row = mysqli_fetch_assoc($res)) {
                    echo <<<HTML
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                        <img src="{$path}{$row['facilities_image']}" alt="{$row['facilities_name']}" width="40px">
                        <h5 class="mt-3">{$row['facilities_name']}</h5>
                    </div>
                HTML;
                }
                ?>
                <div class="col-lg-12 text-center mt-5">
                    <a href="../hotel/facilities.php" class="btn btn-sm btn-outline-dark round-0 fw-bold shadow-none">
                        More Facilities <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Facilities -->

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>
    <div class="line"></div>
    <div class="reviews mt-5">
        <div class="swiper swiperTestimonials">
            <div class="swiper-wrapper">

                <div class="swiper-slide testi slideTestimonials py-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="../hotel/images/about/me.jpg" alt="Profile" width="30px" />
                        <h6 class="m-0 ms-2">Om Shree 1</h6>
                    </div>
                    <p>
                        Sometimes it is hard to introduce yourself because you know yourself so well that you do not
                        know where to start with. Let me give a t
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide slideTestimonials py-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="../hotel/images/about/me.jpg" alt="Profile" width="30px" />
                        <h6 class="m-0 ms-2">Om Shree 2</h6>
                    </div>
                    <p>
                        Sometimes it is hard to introduce yourself because you know yourself so well that you do not
                        know where to start with. Let me give a t
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide slideTestimonials py-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="../hotel/images/about/me.jpg" alt="Profile" width="30px" />
                        <h6 class="m-0 ms-2">Om Shree 3</h6>
                    </div>
                    <p>
                        Sometimes it is hard to introduce yourself because you know yourself so well that you do not
                        know where to start with. Let me give a t
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide slideTestimonials py-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="../hotel/images/about/me.jpg" alt="Profile" width="30px" />
                        <h6 class="m-0 ms-2">Om Shree 4</h6>
                    </div>
                    <p>
                        Sometimes it is hard to introduce yourself because you know yourself so well that you do not
                        know where to start with. Let me give a t
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
        <a href="aboutUs.php" class="btn btn-sm btn-outline-dark round-0 fw-bold shadow-none">
            Know More <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    <!-- Testimonials -->

    <!-- Reach Us -->

    <?php
$contact_q = "SELECT * FROM `contact_detail` WHERE `id`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
// print_r($contact_r);
?>


    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>
    <div class="line"></div>
    <div class="container contact">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-3 rounded">
                <iframe class="w-100 rounded shadow" src="<?php echo $contact_r["iframe_link"]; ?>" width="100%"
                    height="300" frameborder="0" height="320" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="reachUs col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded shadow mb-4">
                    <h5>Contact Us</h5>
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <a href="tel: <?php echo $contact_r["contactNumber_1"]; ?>" class="d-inline-block mb-2 
                    text-decoration-none text-dark">
                                <i class="bi bi-telephone-fill"></i> +91-<?php echo $contact_r["contactNumber_1"]; ?>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <?php
                            if ($contact_r['contactNumber_2'] != '') {
                                echo <<<data
                                <a href="tel: $contact_r[contactNumber_2]" class="d-inline-block mb-2
                            text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i> +91-$contact_r[contactNumber_2]
                            </a>
                            data;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded shadow mb-4">
                    <h5>Follow Us </h5>
                    <div class="links justify-content-around d-flex">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none text-dark " target="_blank">
                        <i class="bi bi-instagram"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['meta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[meta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none text-dark ">
                        <i class="bi bi-meta"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['twitter_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[twitter_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none text-dark ">
                        <i class="bi bi-twitter-x"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['youtube_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[youtube_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none text-dark ">
                        <i class="bi bi-youtube"></i>
                        </a>
                        data;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
        <a href="../hotel/contactUs.php" class="btn btn-sm btn-outline-dark round-0 fw-bold shadow-none">
            Reach Us <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
    <!-- Reach Us -->

    <?php require('../hotel/common/footer.php'); ?>




    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    // var preloader = document.getElementById('loading');

    // function myFunction() {
    //     preloader.style.display = 'none';
    // }

    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll("img.lazy-load");

        images.forEach(img => {
            // console.log(`Checking image: ${img.src}`);
            img.addEventListener("load", function() {
                console.log(`Image loaded: ${img.src}`);
                img.classList.add("loaded");
                if (img.previousElementSibling && img.previousElementSibling.classList.contains(
                        "skeleton")) {
                    img.previousElementSibling.classList.add("hidden");
                }
            });

            // For cached images
            if (img.complete) {
                // console.log(`Image already cached: ${img.src}`);
                img.classList.add("loaded");
                if (img.previousElementSibling && img.previousElementSibling.classList.contains(
                        "skeleton")) {
                    img.previousElementSibling.classList.add("hidden");
                }
            }
        });
    });






    var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        }
        // navigation: {
        //     nextEl: ".swiper-button-next",
        //     prevEl: ".swiper-button-prev",
        // },
    });

    var swiper = new Swiper(".swiperTestimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        loop: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            320: {
                slidesPerView: "2",
            },
            640: {
                slidesPerView: "1",
            },
            768: {
                slidesPerView: "2",
            },
            1025: {
                slidesPerView: "3",
            },
        }
    });

    // loop: true, (tab use kerna hai jab bahut reviews ho)
    </script>
</body>

</html>imag