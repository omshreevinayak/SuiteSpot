<?php
require('admin/common/dbConfig.php');
require('admin/common/essential.php');
?>

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

.navbar-main {
    background-image: url('images/carousel/room-bg.png');
    background-attachment: fixed;
    background-size: contain;
    /* Ensures the image covers the entire navbar */
    background-repeat: no-repeat;
    /* Prevents the image from repeating */
    /* background-position: center; */
    /* Centers the image */
    height: 300px;
}

/* Centering the links */
.navbar-nav {
    display: flex;
    justify-content: end;
    width: 100%;
}

/* Adjust height for smaller screens */
@media (max-width: 768px) {
    .navbar-main {
        background-image: url('images/carousel/back-phone.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 300px;
    }
}
</style>

<?php
$contact_q = "SELECT * FROM `contact_detail` WHERE `id`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
// print_r($contact_r);
?>

<nav id="nav_bar" class="navbar navbar-main navbar-expand-lg navbar-inverse">
    <div class="container-fluid">
        <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none fw-bold fs-3 h-font">
            <i class="fa-solid fa-utensils"></i>Vinayak's Hotel
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2">Home</a>
                </li>
                <li><a href="@" class="nav-link px-2">/</a></li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link px-2">Rooms</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




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
    let a_tags = navbar.getElementsByTagName('a'); // Correct method to get all 'a' tags within 'nav_bar'

    for (let i = 0; i < a_tags.length; i++) {
        let file = a_tags[i].href.split('/').pop();
        let file_name = file.split(".")[0]; // Correct the split method and get the file name without extension

        if (document.location.href.indexOf(file_name) >= 0) {
            a_tags[i].classList.add('active');
        }
    }
}

setActive();
</script>