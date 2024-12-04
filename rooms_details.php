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


    .card {
        /* margin-top: 35px; */
        padding: 33px;
        height: auto;
        width: 100%;
        max-width: 850px;
        margin: auto;
        background-color: #ffffff;
        box-shadow: 10px 0 50px rgba(0, 0, 0, 0.2);
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

    swiper-container {
        width: 100%;
        height: 100%;
    }

    swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mySwiper {
        height: auto;
        width: 100%;
    }

    .mySwiper2 {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper2 swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper2 .swiper-slide-thumb-active {
        opacity: 1;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }







    /* SKELETON */


    .skeleton {
        display: inline-block;
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: skeleton-loading 1.5s infinite;
        border-radius: 4px;
    }

    .skeleton-heading {
        height: 2rem;
        width: 20%;
        margin-left: 32rem;
    }

    .skeleton-line {
        height: .5rem;
        width: 20%;
        margin-left: 32rem;
    }

    @keyframes skeleton-loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    .hidden {
        display: none;
    }

    .line {
        width: 13%;
        /* Adjust the width as needed */
        height: 2px;
        /* Adjust the height as needed */
        background-color: black;
        /* Change to your desired color */
        margin: 0 auto;
        /* Center the line */
        position: relative;
        /* Position relative to the heading */
        /* top: -50px; */
        /* Adjust this value to move the line closer to the heading */
    }

    .skeleton-swiper-image-1 {
        width: 100%;
        height: 405px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    .skeleton-swiper-image-2 {
        width: 100%;
        height: 95px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    .skeleton-swiper-image-3 {
        width: 100%;
        height: 95px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    .skeleton-swiper-image-4 {
        width: 100%;
        height: 95px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    .skeleton-swiper-image-5 {
        width: 100%;
        height: 95px;
        /* Adjust the height as needed */
        margin-bottom: 10px;
    }

    .skeleton-name {
        height: 2rem;
        width: 80%;
        margin-top: 2rem;
    }

    /* SKELETON */
    </style>


</head>

<body>

    <?php require('../hotel/common/roomsDetailsheader.php'); ?>
    <?php if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }
    $data = filtration($_GET);
    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `rooms_status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');
    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }
    $room_data = mysqli_fetch_assoc($room_res);
    ?>


    <!-- Rooms -->
    <div class="my-5 px-4" style="margin-bottom: 5rem;">
        <h2 id="skeleton-heading" class="fw-bold h-font text-center skeleton skeleton-heading"></h2>
        <div id="skeleton-line" class="skeleton skeleton-line"></div>
        <div id="content" class="hidden">
            <h2 class="fw-bold h-font text-center">Rooms Details</h2>
            <div class="line"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 mb-lg-0 mb-4 ps-4">
                <!-- Skeleton Loader -->
                <div id="skeleton-swiper-image-1" class="skeleton skeleton-swiper-image-1"></div>
                <div class="row">
                    <div class="col-lg-3">
                        <div id="skeleton-swiper-image-2" class="skeleton skeleton-swiper-image-2"></div>
                    </div>
                    <div class="col-lg-3">
                        <div id="skeleton-swiper-image-3" class="skeleton skeleton-swiper-image-3"></div>
                    </div>
                    <div class="col-lg-3">
                        <div id="skeleton-swiper-image-4" class="skeleton skeleton-swiper-image-4"></div>
                    </div>
                    <div class="col-lg-3">
                        <div id="skeleton-swiper-image-5" class="skeleton skeleton-swiper-image-5"></div>
                    </div>
                </div>


                <div id="swiper-image" class="hidden">
                    <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="mySwiper" thumbs-swiper=".mySwiper2" space-between="10" navigation="false">
                        <?php
                        // Get room default thumbnail
                        $room_image = ROOMS_IMAGE_PATH . "../rooms/room-1.jpg";
                        $img_q = mysqli_query($con, "SELECT * FROM `rooms_image` WHERE `room_images_id`='{$room_data['id']}'");
                        if (mysqli_num_rows($img_q) > 0) {
                            while ($image_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                <swiper-slide>
                                    <img src='" . ROOMS_IMAGE_PATH . $image_res['room_images'] . "' class='d-block w-100 img-fluid rounded photu shadow' alt='Room Image'>
                                </swiper-slide>
                            ";
                            }
                        } else {
                            echo "
                            <swiper-slide>
                                <img src='$room_image' class='d-block w-100 img-fluid rounded photu shadow' alt='Room Image'>
                            </swiper-slide>
                        ";
                        }
                        ?>
                    </swiper-container>

                    <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                        watch-slides-progress="true" style="cursor: pointer;">
                        <?php
                        // Get room default thumbnail
                        $img_q = mysqli_query($con, "SELECT * FROM `rooms_image` WHERE `room_images_id`='{$room_data['id']}'");
                        if (mysqli_num_rows($img_q) > 0) {
                            while ($image_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                <swiper-slide>
                                    <img src='" . ROOMS_IMAGE_PATH . $image_res['room_images'] . "' class='d-block w-100 img-fluid rounded photu shadow' alt='Room Image'>
                                </swiper-slide>
                            ";
                            }
                        } else {
                            echo "
                            <swiper-slide>
                                <img src='$room_image' class='d-block w-100 img-fluid rounded photu shadow' alt='Room Image'>
                            </swiper-slide>
                        ";
                        }
                        ?>
                    </swiper-container>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card border-0 rounded-3">
                    <div class="card-body">
                        <!-- Skeleton Loader -->

                        <div id="skeleton-name" class="skeleton skeleton-name"></div>
                        <div id="skeleton-name" class="skeleton skeleton-text"></div>
                        <div id="skeleton-name" class="skeleton skeleton-text"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-text"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-text"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-text"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <div id="skeleton-name" class="skeleton skeleton-badge"></div>
                        <!-- <div class="skeleton skeleton-heading"></div> -->
                        <div class="skeleton skeleton-text"></div>

                        <!-- Actual Content -->
                        <div id="actual-card-body" class="hidden">
                            <?php
                            echo <<<name
        <h2>$room_data[rooms_name]</h2>
        name;

                            echo <<<rating
            <div class="rating">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
            </div>
        rating;

                            // Get room features
                            $fea_q = mysqli_query($con, "SELECT f.features_name FROM `features` f INNER JOIN `room_feature` rfea ON f.id = rfea.features_id WHERE rfea.rooms_id = '{$room_data['id']}'");
                            $room_features = '';
                            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                                $room_features .= "<span class='badge rounded-pill text-bg-secondary text-wrap me-1 mb-1'>{$fea_row['features_name']}</span>";
                            }
                            echo <<<features
        <div class="features mb-3 mt-2">
            <h6 class="mb-1">Features</h6>
            $room_features
        </div>
        features;

                            // Get room facilities
                            $fac_q = mysqli_query($con, "SELECT f.facilities_name FROM `facilities` f INNER JOIN `room_facility` rfac ON f.id=rfac.facilities_id WHERE rfac.rooms_id ='{$room_data['id']}'");
                            $facilities_data = '';
                            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                                $facilities_data .= "<span class='badge rounded-pill text-bg-secondary text-wrap me-1 mb-1'> {$fac_row['facilities_name']}</span>";
                            }
                            echo <<<facilities
        <div class="facilities mb-3">
            <h6 class="mb-1 justify-content-between">Facilities</h6>
            $facilities_data
        </div>
        facilities;

                            echo <<<guest
        <div class="Guests mb-3">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill text-bg-secondary text-wrap me-2">
                Adults: $room_data[rooms_guest_adult]
            </span>
            <span class="badge rounded-pill text-bg-secondary text-wrap">
                Children: $room_data[rooms_guest_children]
            </span>
        </div>
        guest;

                            echo <<<area
        <div class="Guests mb-3">
            <h6 class="mb-1">Room's Area</h6>
            <span class="badge rounded-pill text-secondary text-wrap me-2">
                $room_data[rooms_area] sq/ft
            </span>
        </div>
        area;

                            echo <<<price
        <h4 class='text-center'>₹ $room_data[rooms_price] per/night</h4>
        price;

                            echo <<<bookRoom
        <a href="#" class="btn w-100 btn-dark shadow-none mb-2">Book Now</a>
        bookRoom;
                            ?>
                        </div>
                    </div>

                </div>
            </div>



            <div class="col-12 mt-4 px-4">
                <div class="mb-4">
                    <?php
                    echo <<<description
                    <div class="description mb-3"> 
                        <h6 class="mb-1">Room's Description</h6>
                        <p class='text-secondary'>$room_data[room_description]</p>
                    </div>
                    description;
                    ?>
                </div>
                <div class="col-lg-12 reviews">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="mb-3">Reviews & Ratings</h6>
                            <div class="profile d-flex align-items-center mb-3">
                                <img src="../hotel/images/about/me.jpg" alt="Profile" width="50px"
                                    class="rounded-circle" />
                                <h6 class="m-0 ms-2">Om Shree</h6>
                            </div>
                            <p class="text-secondary">
                                Sometimes it is hard to introduce yourself because you know yourself so well that you do
                                not
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
                        <div class="col-lg-6">
                            <h6 class="mb-3">Reviews & Ratings</h6>
                            <div class="profile d-flex align-items-center mb-3">
                                <img src="../hotel/images/about/me.jpg" alt="Profile" width="50px"
                                    class="rounded-circle" />
                                <h6 class="m-0 ms-2">Om Shree</h6>
                            </div>
                            <p class="text-secondary">
                                Sometimes it is hard to introduce yourself because you know yourself so well that you do
                                not
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
                </div>
            </div>
        </div>
    </div>
    <!-- Rooms -->






    <?php require('../hotel/common/footer.php'); ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
<script>
var preloader = document.getElementById('loading');

function myFunction() {
    preloader.style.display = 'none';
}

var swiper = new Swiper('.mySwiper', {
    spaceBetween: 10,
    navigation: true,
    thumbs: {
        swiper: {
            el: '.mySwiper2',
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        },
    },
});

var swiper2 = new Swiper('.mySwiper2', {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

document.addEventListener('DOMContentLoaded', function() {
    // Simulate data fetching
    setTimeout(function() {
        // Hide the skeleton loaders
        document.getElementById('skeleton-heading').classList.add('hidden');
        document.getElementById('skeleton-line').classList.add('hidden');
        document.getElementById('skeleton-swiper-image-1').classList.add('hidden');
        document.getElementById('skeleton-swiper-image-2').classList.add('hidden');
        document.getElementById('skeleton-swiper-image-3').classList.add('hidden');
        document.getElementById('skeleton-swiper-image-4').classList.add('hidden');
        document.getElementById('skeleton-swiper-image-5').classList.add('hidden');
        document.getElementById('skeleton-name').classList.add('hidden');

        // Show the actual content
        document.getElementById('content').classList.remove('hidden');
        document.getElementById('swiper-image').classList.remove('hidden');
        document.getElementById('actual-card-body').classList.remove('hidden');
    }, 3000); // Simulate a delay of 3 seconds
});
</script>

</html>