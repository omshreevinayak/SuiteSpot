<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vinayak's Hotel - Contact Us</title>
    <link rel="shortcut icon" href="../hotel/images/reception-bell.png" type="image/x-icon">

    <!-- Include SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        /* for mobile */
        @media (max-width:426px) {
            .send {
                margin-left: 6.25rem;
            }
        }

        /* for laptop */
        @media (min-width:426px) {
            .send {
                margin-left: 13rem;
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

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Contact Us</h2>
        <div class="h-lin"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusamus esse, <br>
            blanditiis perferendis quia
            dicta voluptatum impedit dolorum odit eius.
        </p>
    </div>

    <?php
    $contact_q = "SELECT * FROM `contact_detail` WHERE `id`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
    // print_r($contact_r);
    ?>



    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-6 mb-5 px-4">
                <div class="rounded">
                    <iframe class="w-100 rounded shadow-none border-secondary-subtle" src="<?php echo $contact_r["iframe_link"]; ?>" height="320"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r["hotel_map"]; ?>" target="_blank">
                        <i class="bi bi-geo-alt-fill"></i>
                        <?php echo $contact_r["hotel_address"]; ?>
                    </a>
                    <h5 class="mt-3">Contact Us</h5>
                    <div class="links justify-content-around d-flex col-md-7">
                        <a href="tel: <?php echo $contact_r["contactNumber_1"]; ?>" class="d-inline-block mb-2 
                    text-decoration-none">
                            <i class="bi bi-telephone-fill"></i> +91-<?php echo $contact_r["contactNumber_1"]; ?>
                        </a>
                        <?php
                        if ($contact_r['contactNumber_2'] != '') {
                            echo <<<data
                                <a href="tel: $contact_r[contactNumber_2]" class="d-inline-block mb-2
                            text-decoration-none ">
                            <i class="bi bi-telephone-fill"></i> +91-$contact_r[contactNumber_2]
                            </a>
                            data;
                        }
                        ?>
                    </div>

                    <h5 class="mt-3">Email</h5>
                    <a href="mailto:<?php echo $contact_r["hotel_mail"]; ?>" target="_blank">
                        <i class="fa-solid fa-at"></i><?php echo $contact_r["hotel_mail"]; ?>
                    </a>
                    <h5 class="mt-3">Follow Us </h5>
                    <div class="links justify-content-between d-flex col-lg-3">
                        <?php
                        if ($contact_r['insta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[insta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none " target="_blank">
                        <i class="bi bi-instagram"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['meta_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[meta_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none ">
                        <i class="bi bi-meta"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['twitter_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[twitter_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none ">
                        <i class="bi bi-twitter-x"></i>
                        </a>
                        data;
                        }
                        ?>
                        <?php
                        if ($contact_r['youtube_link'] != '') {
                            echo <<<data
                                <a href="<?php echo $contact_r[youtube_link]; ?>" class="d-inline-block mb-2
                        text-decoration-none ">
                        <i class="bi bi-youtube"></i>
                        </a>
                        data;
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-lg-6 mb-5 px-4">
                <div class="bg-white shadow rounded p-4 contactUs-form">
                    <form method="POST">
                        <h5 class="text-center text-decoration-underline">Send a message.</h5>
                        <div class="mt-3">
                            <label class="form-label">Name :</label>
                            <input name="name" type="text" class="form-control 
                        shadow-none border-secondary-subtle" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Email :</label>
                            <input name="email" type="email" class="form-control 
                            shadow-none border-secondary-subtle" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Subject :</label>
                            <input name="subject" type="text" class="form-control 
                            shadow-none border-secondary-subtle" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Message :</label>
                            <textarea name="message" class="form-control shadow-none 
                            border-secondary-subtle" placeholder="Leave a message here..." rows="5" style="resize:none" required></textarea>
                        </div>
                        <button name="send" type="submit" class="btn btn-dark mt-3 send">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (isset($_POST['send'])) {
        $frm_data = filtration($_POST);

        $q = "INSERT INTO `user_quries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $value = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

        $res = insert($q, $value, 'ssss');

        if ($res == 1) {
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Your message has been sent successfully.',
        });
        </script>";
        } else {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error sending your message. Please try again.',
        });
        </script>";
        }
    }
    ?>


    <?php
    require('../hotel/common/footer.php');
    ?>
</body>
<script>
    var preloader = document.getElementById('loading');

    function myFunction() {
        preloader.style.display = 'none';
    }
</script>

</html>