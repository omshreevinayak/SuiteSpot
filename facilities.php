<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinayak's Hotel - Facilities</title>
    <link rel="shortcut icon" href="../hotel/images/reception-bell.png" type="image/x-icon">

    <?php require('../hotel/common/links.php'); ?>

    <style>
        .h-line {
            width: 150px;
            margin: 0 auto;
            height: 1.7px;
        }


        .facilities-facilities-card:hover {
            transform: scale(1.03);
            transition: all .3s;
            cursor: pointer;
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
    </style>


</head>

<body onload="myFunction()">
    <div id="loading">
        <div class="loader"></div>
        <div class="loader"></div>
        <div class="loader"></div>
    </div>

    <?php require('../hotel/common/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Our Facilities</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusamus esse, <br>
            blanditiis perferendis quia
            dicta voluptatum impedit dolorum odit eius.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $res = selectAll('facilities');
            $path = Facilities_IMAGE_PATH;
            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<HTML
                <div class="facilities-facilities-card col-lg-4 col-lg-6 mb-5 px-4">
                    <div class="bg-white rounded shadow p-4 border-top border-4 border-dark">
                        <div class="d-flex align-item-centre mb-2">
                            <img src="{$path}{$row['facilities_image']}" alt="{$row['facilities_name']}" width="40px">
                            <h5 class="ml-3 mt-2">{$row['facilities_name']}</h5>
                        </div>
                        <p>{$row['facilities_description']}</p>
                    </div>
                </div>
            HTML;
            }
            ?>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



    <!-- credits: https://bootstrapcrew.com/snippets/team-members/ -->

    <?php require('../hotel/common/footer.php'); ?>
</body>
<script>
    var preloader = document.getElementById('loading');

    function myFunction() {
        preloader.style.display = 'none';
    }
</script>

</html>