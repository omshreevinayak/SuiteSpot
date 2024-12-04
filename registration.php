<?php
require('admin/common/dbConfig.php');
require('admin/common/essential.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="registration.css">
</head>

<body>

    <?php

    // if (isset($_POST['submit'])) {
    //     // Retrieve and escape inputs
    //     $name = mysqli_real_escape_string($con, $_POST['name']);
    //     $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    //     $username = mysqli_real_escape_string($con, $_POST['username']);
    //     $number = mysqli_real_escape_string($con, $_POST['number']);
    //     $email = mysqli_real_escape_string($con, $_POST['email']);
    //     $password = mysqli_real_escape_string($con, $_POST['password']);
    //     $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

    //     // Check if passwords match
    //     if ($password === $confirmPassword) {
    //         // Hash the password
    //         $ProtectedPassword = password_hash($password, PASSWORD_BCRYPT);

    //         // Check if email already exists
    //         $emailQuery = "SELECT * FROM `signup_cred` WHERE email = ?";
    //         $stmt = mysqli_prepare($con, $emailQuery);
    //         mysqli_stmt_bind_param($stmt, 's', $email);
    //         mysqli_stmt_execute($stmt);
    //         $result = mysqli_stmt_get_result($stmt);
    //         $emailCount = mysqli_num_rows($result);

    //         if ($emailCount > 0) {
    //             echo "<script>Swal.fire('Error', 'Email Already Exists', 'error');</script>";
    //         } else {
    //             // Insert user data into the database
    //             $insertQuery = "INSERT INTO `signup_cred`(`name`, `lastName`,`username`, `number`, `email`, `password`) VALUES (?, ?, ?, ?,?,?)";
    //             $stmt = mysqli_prepare($con, $insertQuery);
    //             mysqli_stmt_bind_param($stmt, 'ssssss', $name, $lastName, $username, $number, $email, $ProtectedPassword);
    //             $iquery = mysqli_stmt_execute($stmt);

    //             if ($iquery) {
    //                 echo "<script>Swal.fire('Success', 'Registration Successful', 'success');</script>";
    //             } else {
    //                 echo "<script>Swal.fire('Error', 'Registration Failed', 'error');</script>";
    //             }
    //         }
    //     } else {
    //         echo "<script>Swal.fire('Error', 'Passwords Do Not Match', 'error');</script>";
    //     }
    // }

    ?>

    <?php

    if (isset($_POST['submit'])) {
        // Retrieve and escape inputs
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $number = mysqli_real_escape_string($con, $_POST['number']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

        // Check if passwords match
        if ($password === $confirmPassword) {
            // Hash the password
            $ProtectedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Check if email already exists
            $emailQuery = "SELECT * FROM `signup_cred` WHERE email = ?";
            $stmt = mysqli_prepare($con, $emailQuery);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $emailCount = mysqli_num_rows($result);

            if ($emailCount > 0) {
                echo "<script>Swal.fire('Error', 'Email Already Exists', 'error');</script>";
            } else {
                // Handle image upload
                $profilePicPath = '';
                if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
                    $uploadDirectory = USER_FOLDER;
                    $fileName = basename($_FILES['profile_pic']['name']);
                    $fileTmpName = $_FILES['profile_pic']['tmp_name'];
                    $profilePicPath = $uploadDirectory . $fileName;

                    if (move_uploaded_file($fileTmpName, $profilePicPath)) {
                        $profilePicPath = USER_IMAGE_PATH . $fileName; // Set path to be stored in the database
                    } else {
                        echo "<script>Swal.fire('Error', 'Failed to upload profile picture', 'error');</script>";
                    }
                }

                // Insert user data into the database
                $insertQuery = "INSERT INTO `signup_cred`(`name`, `lastName`, `username`, `number`, `email`, `password`, `profile_pic`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $insertQuery);
                mysqli_stmt_bind_param($stmt, 'sssssss', $name, $lastName, $username, $number, $email, $ProtectedPassword, $profilePicPath);
                $iquery = mysqli_stmt_execute($stmt);

                if ($iquery) {
                    echo "<script>Swal.fire('Success', 'Registration Successful', 'success');</script>";
                } else {
                    echo "<script>Swal.fire('Error', 'Registration Failed', 'error');</script>";
                }
            }
        } else {
            echo "<script>Swal.fire('Error', 'Passwords Do Not Match', 'error');</script>";
        }
    }

    ?>



    <!-- <div class="wrapper">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Sign Up</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="lastName" required>
                        </div>
                        <div class="input-field">
                            <label>Username</label>
                            <input type="text" name="username" required>
                        </div>
                    </div>


                    <div class="input-field">
                        <label>Phone Number</label>
                        <input type="text" name="number" required>
                    </div>
                </div>


                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name="password" required>
                            <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword(this)"></i>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmPassword" required>
                            <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword(this)"></i>
                        </div>
                        <div class="input-field">
                            <label>Your E-mail</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" name="submit">Sign Up</button>
            <div class="register">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div> -->

    <div class="wrapper">
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Sign Up</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="lastName" required>
                        </div>
                        <div class="input-field">
                            <label>Username</label>
                            <input type="text" name="username" required>
                        </div>
                    </div>

                    <div class="input-field">
                        <label>Phone Number</label>
                        <input type="text" name="number" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" name="password" required>
                            <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword(this)"></i>
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmPassword" required>
                            <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePassword(this)"></i>
                        </div>
                        <div class="input-field">
                            <label>Your E-mail</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_pic" accept="image/*" required>
                </div>
            </div>

            <button type="submit" name="submit">Sign Up</button>
            <div class="register">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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


</body>

</html>