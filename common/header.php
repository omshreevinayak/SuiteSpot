<?php
require('admin/common/dbConfig.php');
require('admin/common/essential.php');
// define('SITE_URL', 'http://192.168.1.45/hotel/');
// define('USER_IMAGE_PATH', SITE_URL . 'images/user/');
// define('USER_FOLDER', 'C:/xampp/htdocs/hotel/user/');

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    * {
        font-family: "Tilt Neon", sans-serif;
    }

    ::-webkit-scrollbar {
        width: .525rem;
    }

    ::-webkit-scrollbar-track {
        background-color: white;
    }

    ::-webkit-scrollbar-thumb {
        background-color: black;
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

    #nav_bar .logo {
        color: black !important;
    }

    .active {
        color: black !important;
        /* Use !important to override other styles */
    }

    .navbar-main {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(10.5px);
        -webkit-backdrop-filter: blur(10.5px);
        /* border-radius: 10px; */
        z-index: 200;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    #signUpModal,
    #loginModal {
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

    /* .availabilities-form {
        z-index: 100;
        margin-top: -4rem;
        position: relative;
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(7px);
        -webkit-backdrop-filter: blur(7px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    } */

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

    .testimonials {
        background: url(../hotel/images/carousel/back.jpg);
        background-repeat: no-repeat;
        background-size: 100%;
        background-attachment: fixed;
        position: relative;
    }

    .slideTestimonials {
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }


    /* for mobile */
    @media (max-width:426px) {

        .navbar-nav {
            align-items: center;
        }

        .modal-title {
            margin-left: 5rem;
        }

        .modal-signUp {
            margin-left: 6rem;
        }

        .login-signup {
            margin-right: 6rem;
        }

        .laptop {
            display: none;
        }

        .phone {
            margin-top: 1rem;
        }

        .availabilities-form {
            margin: 1rem .5rem;
        }

        .availabilities-form {
            margin-top: -10rem;
        }

        .availabilities-btn .btn {
            margin-left: 6rem;
        }

        .testimonials {
            background: url(../hotel/images/carousel/back-phone.jpg);
            background-repeat: no-repeat;
            background-size: 100%;
            background-attachment: fixed;
            position: relative;
        }
    }

    /* for laptop */
    @media (min-width:426px) {

        .navbar-nav-main {
            margin-left: 11rem;
        }

        .modal-title {
            margin-left: 9rem;
        }

        .modal-signUp {
            margin-left: 19rem;
        }

        .phone {
            display: none;
        }

        .laptop {
            margin-top: 1rem;
        }

        .reachUs {
            margin-top: 2.25rem;
        }
    }
</style>



<!-- <nav id="nav_bar" class="navbar navbar-main navbar-expand-lg navbar-inverse">
    <div class="container-fluid ">
        <a href="home.php" class="d-inline-flex logo
                    link-body-emphasis text-decoration-none 
                    fw-bold fs-3 h-font">
            <i class="fa-solid fa-person-booth"></i>SuiteSpot
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="nav-items 
            collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav  navbar-nav-main me-auto mb-2 mb-lg-0 justify-content-center">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2 ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link px-2 ">Rooms</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="facilities.php" class="nav-link px-2  facilities">Facilities</a>
                </li>
                <li class="nav-item">
                    <a href="contactUs.php" class="nav-link px-2 ">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="aboutUs.php" class="nav-link px-2 ">About Us</a>
                </li>
            </ul>
            <div class="login-signup col-md-3 text-end">
                <a href="login.php" rel="noopener noreferrer">
                    <button type="button" class="btn btn-dark me-2">
                        Login
                    </button>
                </a>
                <a href="registration.php" rel="noopener noreferrer">
                    <button type="button" class="btn btn-outline-dark">
                        Sign-up
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav> -->




<?php
// Ensure the database connection is included

// Define constants
define('DEFAULT_IMAGE', 'default.png');

// Fetch the user's profile picture from the database if the user is logged in
$profilePicPath = SITE_URL . USER_FOLDER . DEFAULT_IMAGE; // Default image path

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT profile_pic FROM signup_cred WHERE username = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user['profile_pic'])) {
        // Construct the actual image URL
        $profilePicPath = SITE_URL . USER_FOLDER . htmlspecialchars($user['profile_pic']);
    }
}
?>

<nav id="nav_bar" class="navbar navbar-main navbar-expand-lg navbar-inverse">
    <div class="container-fluid ">
        <a href="home.php" class="d-inline-flex logo link-body-emphasis text-decoration-none fw-bold fs-3 h-font">
            <i class="fa-solid fa-person-booth"></i>SuiteSpot
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="nav-items collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-nav-main me-auto mb-2 mb-lg-0 justify-content-center">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2 ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link px-2 ">Rooms</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="facilities.php" class="nav-link px-2  facilities">Facilities</a>
                </li>
                <li class="nav-item">
                    <a href="contactUs.php" class="nav-link px-2 ">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a href="aboutUs.php" class="nav-link px-2 ">About Us</a>
                </li>
            </ul>
            <div class="login-signup col-md-3 text-end">
                <?php if (isset($_SESSION['username'])) : ?>
                    <?php
                    // Fetch the user's profile picture from the database
                    $username = $_SESSION['username'];
                    $query = "SELECT profile_pic FROM signup_cred WHERE username = ?";
                    $stmt = mysqli_prepare($con, $query);
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $user = mysqli_fetch_assoc($result);
                    $profilePic = $user['profile_pic'] ?? 'default.png'; // Use default.png if no profile pic is found

                    // Ensure the profile picture path is correctly constructed
                    $profilePicPath = USER_IMAGE_PATH . htmlspecialchars($profilePic);

                    // Check if the file exists, if not use the default image path
                    if (!empty($user['profile_pic'])) {
                        // Construct the actual image URL
                        $profilePicPath = SITE_URL . USER_FOLDER . htmlspecialchars($user['profile_pic']);
                    }
                    ?>
                    <div class="flex-shrink-0 dropdown">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $profilePicPath; ?>" alt="User Image" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <!-- <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> -->
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <a href="login.php" rel="noopener noreferrer">
                        <button type="button" class="btn btn-dark me-2">Login</button>
                    </a>
                    <a href="registration.php" rel="noopener noreferrer">
                        <button type="button" class="btn btn-outline-dark">Sign-up</button>
                    </a>
                <?php endif; ?>
            </div>




        </div>
    </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    <?php if (isset($_SESSION['username'])) : ?>
        Swal.fire('Welcome', 'Welcome <?php echo $_SESSION['username']; ?>', 'success');
    <?php endif; ?>

    document.getElementById('logoutBtn').addEventListener('click', function() {
        window.location.href = 'logout.php';
    });
</script>



<script>
    let navBar = document.querySelectorAll('.nav-link');
    let navbarCollapse = document.querySelector('.navbar-collapse .collapse');
    navBar.forEach(function(a) {
        a.addEventListener('click', function() {
            navbarCollapse.classList.remove('show');
        })
    })

    function setActive() {
        let navbar = document.getElementById('nav_bar');
        let a_tags = 
        navbar.getElementsByTagName('a'); // Correct method to get all 'a' tags within 'nav_bar'

        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split(".")[0]; // Correct the split method and get the file name without extension

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    setActive();



    document.addEventListener('DOMContentLoaded', function() {
        let signUp_form = document.getElementById('signUp_form');

        signUp_form.addEventListener('submit', function(e) {
            e.preventDefault();

            let data = new FormData(signUp_form);
            data.append('profile_pic', signUp_form.elements['profile_pic'].files[0]);

            var myModal = document.getElementById('signUpModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/hotel/ajaxForUser/signUp.php", true);
            xhr.onload = function() {
                let response = this.responseText.trim();
                console.log("Server response:", response); // Log the response for debugging
                if (response === "Bsdk password Sahi se likh") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Password and Confirm Password are not the same'
                    });
                } else if (response === "email_already") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Email already exists'
                    });
                } else if (response === "inv_img") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Invalid Image'
                    });
                } else if (response === "upd_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Image upload failed'
                    });
                } else if (response === "mail_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Mail sending failed'
                    });
                } else if (response === "ins_failed") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to insert data'
                    });
                } else if (response === "1") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Registration successful! Please check your email for confirmation.'
                    });
                    signUp_form.reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred: ' + response
                    });
                }
            };
            xhr.onerror = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Request failed'
                });
            };
            xhr.send(data);
        });
    });
</script>