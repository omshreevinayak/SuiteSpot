<!-- <nav class="navbar navbar-main navbar-expand-lg sticky-top navbar-inverse">
    <div class="container-fluid ">
        <a href="home.php" class="d-inline-flex 
                    link-body-emphasis text-decoration-none 
                    fw-bold fs-3 h-font">
            <i class="fa-solid fa-bell-concierge"></i>Vinayak's Hotel
        </a>
        <div class="nav-items  justify-content-center" id="navbarSupportedContent">
            <div class="login-signup col-md-3 text-end">
                <a href="logout.php">
                    <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Logout
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>



<div class="col-lg-2 bg-white rounded shadow" id="dashboardMenu">
    <nav class="navbar navbar-expand-lg border-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h2 class="mt-2 AdminPanel">Admin Panel</h2>
            <button class="navbar-toggler 
                        shadow-none 
                        border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown"
                aria-controls="adminDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="collapse navbar-collapse 
                flex-column align-items-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="dashboard.php">
                            <img src="../admin/images/dashboard.png" alt="" width="15px"
                                style="padding-right:2px; padding-bottom:2px;">Dashboard
                        </a>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-building"></i>Rooms
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="bi bi-people-fill"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="setting.php">
                            <i class="bi bi-gear"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div> -->

<style>
    .navbar {
        background: url(../images/carousel/bg-1.jpg) no-repeat;
        background-size: cover;
        background-position: center;
        height: 30vh;
    }
</style>

<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">
                <i class="fa-solid fa-utensils"></i>Vinayak's Hotel
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Admin Elements
            </li>
            <li class="sidebar-item">
                <a href="dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="rooms.php" class="sidebar-link "><i class="fa-solid fa-bed pe-2"></i>
                    Rooms
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link"><i class="fa-solid fa-users-rectangle pe-2"></i>
                    Users
                </a>
            </li>
            <li class="sidebar-item">
                <a href="userquery.php" class="sidebar-link"><i class="fa-solid fa-clipboard-question pe-2"></i>
                    Users Queries
                </a>
            </li>
            <li class="sidebar-item">
                <a href="featureFacilities.php" class="sidebar-link"><i
                        class="fa-solid fa-wand-magic-sparkles pe-2"></i>
                    Features & Facilities
                </a>
            </li>
            <li class="sidebar-item">
                <a href="carousel.php" class="sidebar-link"><i class="fa-solid fa-panorama"></i>
                    Carousel
                </a>
            </li>
            <li class="sidebar-item">
                <a href="setting.php" class="sidebar-link"><i class="fa-solid fa-sliders pe-2"></i>
                    Settings
                </a>
            </li>
            <li class="sidebar-item">
                <a href="logout.php" class="sidebar-link"><i class="fa-solid fa-right-from-bracket pe-2"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</aside>
<div class="main">
    <nav class="navbar navbar-expand px-3 border-bottom">
        <button class="btn shadow-none border-0" id="sidebar-toggle" type="button">
            <i class="fa-solid fa-bars-staggered" style="color: black;"></i>
        </button>
    </nav>