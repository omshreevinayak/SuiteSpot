<?php


// Include required files
require('../admin/common/dbConfig.php');
require('../admin/common/essential.php');




if (isset($_POST['signUp_form'])) {
    error_log("Form is set");

    $data = filtration($_POST);
    error_log("Data after filtration: " . print_r($data, true));

    // Match and confirm the password
    if ($data['password'] != $data['confirmPassword']) {
        echo "Bsdk password Sahi se likh";
        exit;
    }

    // Checking if the user already exists in the database
    // $user_exist = select("SELECT * FROM `signup_cred` WHERE `email` = ? OR `number` = ? LIMIT 1", [$data['email'], $data['number']], "ss");
    // if ($user_exist === false) {
    //     error_log("Database select query failed");
    //     echo 'db_select_failed';
    //     exit;
    // }
    // error_log("User exist query executed");

    // if (mysqli_num_rows($user_exist) != 0) {
    //     $user_exist_fetch = mysqli_fetch_assoc($user_exist);
    //     if ($user_exist_fetch['email'] == $data['email']) {
    //         echo 'email_already';
    //     } else {
    //         echo 'phone_already';
    //     }
    //     exit;
    // }

    // Upload user image
    $img = UploadUserImage($_FILES['profile_pic']);
    error_log("Image upload result: " . $img);
    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit;
    }

    $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(16)); // Ensure you have $token defined properly
    $query = "INSERT INTO `signup_cred`(`name`, `email`, `number`, `profile_pic`, `address`, `zipcode`, `dob`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
    $value = [$data['name'], $data['email'], $data['number'], $img, $data['address'], $data['zipcode'], $data['dob'], $enc_pass, $token];

    // try {
    //     if (insert($query, $value, 'sssssssss')) {
    //         error_log("Data inserted successfully");

    //         // Send confirmation link to user
    //         if (!sendMail($data['email'], $data['name'], $token)) {
    //             error_log("Mail sending failed");
    //             echo 'mail_failed';
    //             exit;
    //         }

    //         echo 1;
    //     } else {
    //         error_log("Data insertion failed");
    //         echo 'ins_failed';
    //     }
    // } catch (Exception $e) {
    //     error_log("Error during insertion: " . $e->getMessage());
    //     echo 'ins_failed';
    // }
} else {
    error_log("Form not set");
}
