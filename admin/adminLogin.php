<?php
require('../admin/common/dbConfig.php');
session_start();
if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    echo "<script>
window.location.href='adminLogin.php';
</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinayak's Hotel - Admin Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../admin/images/reception-bell.png" type="image/x-icon">
    <?php require('../admin/common/links.php'); ?>
    <?php require('../admin/common/essential.php'); ?>
    <style>
    body {
        background: url(../images/adminLogin_bg.svg);
        background-size: cover;
        background-size: 100vw;
    }

    a:hover {
        color: black;
        text-decoration: underline;
    }

    .password {
        background-color: #fff;
        border-radius: 5px;
    }

    .password input {
        border: 0;
        outline: 0;
        padding-left: 2.5rem;
    }

    .field-icon {
        width: 30px;
        padding-right: .5rem;
        cursor: pointer;
    }

    .login-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    @keyframes spin {

        0%,
        100% {
            transform: translate(0)
        }

        25% {
            transform: translate(160%)
        }

        50% {
            transform: translate(160%, 160%)
        }

        75% {
            transform: translate(0, 160%)
        }
    }

    /* for mobile */
    @media (max-width:426px) {
        body {
            background: url(../images/adminLogin_bg-1.svg) no-repeat;
            background-size: 100vh;
        }

        .login-form {
            width: 300px;
        }
    }
    </style>
</head>

<body>
    <div class="login-form text-center">
        <form method="POST" action="adminLogin.php">
            <h4 class="py-3">Admin Login Panel</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_id" type="text" class="form-control shadow-none 
                    text-center border-secondary" placeholder="Admin's Id" style="background-color: transparent;">
                </div>
                <div class="password mb-4 d-flex align-items-center border border-secondary"
                    style="background-color: transparent;">
                    <input name="admin_password" type="password" class="form-control shadow-none 
                    text-center 
                    " placeholder="Password" id="adminPassword" style="background-color: transparent;">
                    <img class="field-icon" src="../admin/images/eye-slash-regular.svg" alt="" id="eye">
                </div>
                <button name="admin_login" class="btn btn-dark shadow-none">Login</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['admin_id']) && isset($_POST['admin_password'])) {
            $frm_data = filtration($_POST);
            $query = "SELECT * FROM `admin_login` WHERE `admin_id`=? AND `admin_password`=?";
            $value = [$frm_data['admin_id'], $frm_data['admin_password']];
            $res = select($query, $value, "ss");

            if ($res->num_rows == 1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['id'];
                redirect('dashboard.php');
                echo <<<alerts
                <script>
                Swal.fire({
                    title: "",
                    icon: "success"
                });
                </script>
                alerts;
            } else {
                echo <<<alerts
                <script>
                Swal.fire({
                    title: "Access is denied.",
                    text: "Please enter the valid user id and password.",
                    icon: "error"
                });
                </script>
                alerts;
            }
        } else {
            echo <<<alerts
            <script>
            Swal.fire({
                title: "Missing data",
                text: "Admin ID and Password are required.",
                icon: "error"
            });
            </script>
            alerts;
        }
    }
    ?>

</body>

<script>
let eye = document.getElementById('eye');
let adminPassword = document.getElementById('adminPassword');

eye.onclick = function() {
    if (adminPassword.type == 'password') {
        adminPassword.type = 'text';
        eye.src = "../admin/images/eye-solid.svg";
    } else {
        adminPassword.type = 'password';
        eye.src = "../admin/images/eye-slash-regular.svg";

    }
}
</script>

</html>