<?php
// This is use for frontend only 👇👇
define('SITE_URL', 'http://192.168.1.38/hotel/');
define('ABOUT_IMG_PATH', SITE_URL . 'images/about/');
define('CAROUSEL_IMAGE_PATH', SITE_URL . 'images/carousel/');
define('Facilities_IMAGE_PATH', SITE_URL . 'images/facilities/');
define('ROOMS_IMAGE_PATH', SITE_URL . 'images/rooms/');
define('USER_IMAGE_PATH', SITE_URL . 'images/user/');

// This is used for backend only 👇👇
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hotel/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('Facilities_FOLDER', 'facilities/');
define('ROOM_FOLDER', 'rooms/');
define('USER_FOLDER', 'user/');




// define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hotel/images/');
// define('ABOUT_FOLDER', 'about/');
function redirect($url)
{
    echo "<script>
    window.location.href='$url';
    </script>";
    exit;
}

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "<script>
    window.location.href='adminLogin.php';
    </script>";
        exit;
    }
}

function upload_images($image, $folder)
{
    $valid_mine = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];
    $img_mine = $image['type'];
    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    } else if ($image['size'] / (1024 * 1024) > 10) {
        return 'inv_size'; //greater than 10mb
    } else {
        $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);
        $serial_number = time();
        $new_img_name = 'img_' . $serial_number . '.' . $extract_img; //If this will not work to esko use kerna => $new_img_name='IMG_'.random_int(111111,999999)."$extract_img";
        $upload_path = UPLOAD_IMAGE_PATH . $folder . $new_img_name;
        if (move_uploaded_file($image['tmp_name'], $upload_path)) {
            return $new_img_name;
        } else {
            return 'upd_failed';
        }
    }
}

function upload_carousel_image($image, $folder)
{
    $valid_mine = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];
    $img_mine = $image['type'];
    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    } else if ($image['size'] / (1024 * 1024) > 10) {
        return 'inv_size'; //greater than 10mb
    } else {
        $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);
        $serial_number = time();
        $new_img_name = 'img_' . $serial_number . '.' . $extract_img; //If this will not work to esko use kerna => $new_img_name='IMG_'.random_int(111111,999999)."$extract_img";
        $upload_path = UPLOAD_IMAGE_PATH . $folder . $new_img_name;
        if (move_uploaded_file($image['tmp_name'], $upload_path)) {
            return $new_img_name;
        } else {
            return 'upd_failed';
        }
    }
}

function deleteImages($image, $folder)
{
    echo (UPLOAD_IMAGE_PATH . $folder . $image);
    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true;
    } else {
        return false;
    }
}

function delete_carousel_image($image, $folder)
{
    echo (UPLOAD_IMAGE_PATH . $folder . $image);
    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true;
    } else {
        return false;
    }
}

// function upload_room_image($image, $folder)
// {
//     $valid_mime = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];
//     $img_mime = $image['type'];

//     // Validate image MIME type
//     if (!in_array($img_mime, $valid_mime)) {
//         return 'inv_img';
//     }

//     // Validate image size (greater than 10MB)
//     if ($image['size'] / (1024 * 1024) > 10) {
//         return 'inv_size';
//     }

//     $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);
//     $serial_number = time();
//     $new_img_name = 'img_' . $serial_number . '.' . $extract_img;

//     // Ensure the folder path ends with a slash
//     if (substr($folder, -1) !== '/') {
//         $folder .= '/';
//     }

//     $upload_path = $folder . $new_img_name;

//     // Create the directory if it doesn't exist
//     if (!is_dir($folder) && !mkdir($folder, 0777, true)) {
//         return 'folder_creation_failed';
//     }

//     // Move the uploaded file to the target directory
//     if (move_uploaded_file($image['tmp_name'], $upload_path)) {
//         return $new_img_name;
//     } else {
//         return 'upd_failed';
//     }
// }

function upload_room_images($image, $folder)
{
    // Define valid MIME types
    $valid_mime = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];

    // Get MIME type of the uploaded file
    $img_mime = $image['type'];

    // Validate the file MIME type
    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // Invalid image format
    }

    // Validate file size (greater than 10MB)
    if ($image['size'] / (1024 * 1024) > 10) {
        return 'inv_size';
    }

    // Extract file extension
    $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);

    // Generate a new image name
    $serial_number = time();
    $new_img_name = 'img_' . $serial_number . '.' . $extract_img;

    // Define the upload path
    $upload_path = UPLOAD_IMAGE_PATH . $folder . '/' . $new_img_name;

    // Ensure the upload directory exists
    if (!file_exists(UPLOAD_IMAGE_PATH . $folder)) {
        if (!mkdir(UPLOAD_IMAGE_PATH . $folder, 0777, true)) {
            return 'folder_creation_failed'; // Failed to create the upload directory
        }
    }

    // Move the uploaded file to the new location
    if (move_uploaded_file($image['tmp_name'], $upload_path)) {
        return $new_img_name; // Return the new image name on success
    } else {
        return 'upd_failed'; // Failed to upload the image
    }
}

function delete_room_images($image, $folder)
{
    echo (UPLOAD_IMAGE_PATH . $folder . $image);
    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true;
    } else {
        return false;
    }
}

function UploadUserImage($image)
{
    $valid_mine = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];
    $img_mine = $image['type'];
    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    } else {
        $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);
        $serial_number = time();
        $new_img_name = 'img_' . $serial_number . '.' . ".jpeg"; //If this will not work to esko use kerna => $new_img_name='IMG_'.random_int(111111,999999)."$extract_img";

        $upload_image_path = UPLOAD_IMAGE_PATH . USER_FOLDER . $new_img_name;
        if ($extract_img == 'png' || $extract_img == 'PNG') {
            $img = imagecreatefrompng($image['temp_name']);
        } else if ($extract_img == 'webp' || $extract_img == 'WEBP') {
            $img = imagecreatefromwebp($image['temp_name']);
        } else {
            $img = imagecreatefromjpeg($image['temp_name']);
        }



        if (imagejpeg($img, $upload_image_path, 90)) {
            return $new_img_name;
        } else {
            return 'upd_failed';
        }
    }
}
