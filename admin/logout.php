<?php require ('../admin/common/essential.php');
session_start();
session_destroy();
redirect('adminLogin.php');
?>