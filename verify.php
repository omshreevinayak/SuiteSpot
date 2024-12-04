<?php
require('admin/common/dbConfig.php');
require('admin/common/essential.php');
?>
<?php
session_start();

if (isset($_GET['code'])) {
    $verificationCode = mysqli_real_escape_string($con, $_GET['code']);

    // Check if the verification code exists and is not expired
    $query = "SELECT * FROM `signup_cred` WHERE token = ? AND t_expire > NOW()";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $verificationCode);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Verify the user
        $updateQuery = "UPDATE `signup_cred` SET is_verified = 1, token = NULL, t_expire = NULL WHERE token = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, 's', $verificationCode);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>Swal.fire('Success', 'Your email has been verified successfully.', 'success');</script>";
        } else {
            echo "<script>Swal.fire('Error', 'Failed to verify email.', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Error', 'Invalid or expired verification code.', 'error');</script>";
    }
} else {
    echo "<script>Swal.fire('Error', 'No verification code provided.', 'error');</script>";
}
