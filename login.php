<?php
require('admin/common/dbConfig.php');
require('admin/common/essential.php');
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="registration.cs">

</head>

<body>

    <?php
    if (isset($_POST['submit'])) {

        // Print debugging information (optional)
        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        echo "</pre>";


        $username = $_POST['username'];
        $password = $_POST['password'];
        $username_search = "SELECT * FROM `signup_cred` WHERE username='$username'";
        $q = mysqli_query($con, $username_search);
        $username_count = mysqli_num_rows($q);

        if ($username_count) {
            $username_pass = mysqli_fetch_assoc($q);
            $db_pass = $username_pass['password'];
            $_SESSION['username'] = $username_pass['username'];
            $pass_decode = password_verify($password, $db_pass);
            if ($pass_decode) {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>";
    ?>
    <script>
    location.replace("home.php");
    </script>
    <?php
                header('location: home.php');
            } else {
                echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Password is incorrect',
        showConfirmButton: false,
        timer: 1500
    });
    </script>";
            }
        } else {
            echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Username is incorrect',
        showConfirmButton: false,
        timer: 1500
    });
    </script>";
        }
    }
    ?>

    <div class="wrapper">
        <form action="#" method="POST">
            <h2>Login</h2>
            <div class="input-field">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required>
                <label>Enter your password</label>
                <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword(this)"></i>
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" name="submit">Log In</button>
            <div class="register">
                <p>Don't have an account? <a href="registration.php">Register</a></p>
            </div>
        </form>
    </div>

    <script>
    function togglePassword(element) {
        const input = element.parentElement.querySelector('input');
        if (input.type === "password") {
            input.type = "text";
            element.classList.remove("fa-eye-slash");
            element.classList.add("fa-eye");
        } else {
            input.type = "password";
            element.classList.remove("fa-eye");
            element.classList.add("fa-eye-slash");
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>