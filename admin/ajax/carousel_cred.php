<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();


// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_carousel_image') {
//     // Start output buffering to capture any potential errors
//     ob_start();

//     $response = ['status' => '', 'message' => ''];

//     if (isset($_FILES['carousel_image']) && isset($_POST['carousel_carousel_name'])) {
//         $carousel_carousel_name = $_POST['carousel_carousel_name'];
//         $carousel_carousel_name = upload_images($_FILES['carousel_image'], CAROUSEL_FOLDER);

//         if ($carousel_carousel_name == 'inv_img') {
//             $response['status'] = 'error';
//             $response['message'] = 'Invalid image type!';
//         } else if ($carousel_carousel_name == 'inv_size') {
//             $response['status'] = 'error';
//             $response['message'] = 'Image size is too large!';
//         } else if ($carousel_carousel_name == 'folder_creation_failed') {
//             $response['status'] = 'error';
//             $response['message'] = 'Failed to create directory!';
//         } else if ($carousel_carousel_name == 'upd_failed') {
//             $response['status'] = 'error';
//             $response['message'] = 'Image upload failed!';
//         } else {
//             // Image uploaded successfully, now insert into database
//             $servercarousel_name = "localhost";
//             $usercarousel_name = "root";
//             $password = "";
//             $dbcarousel_name = "vinayakhotel";

//             $db = new mysqli($servercarousel_name, $usercarousel_name, $password, $dbcarousel_name);

//             if ($db->connect_error) {
//                 $response['status'] = 'error';
//                 $response['message'] = 'Connection failed: ' . $db->connect_error;
//             } else {
//                 $sql = "INSERT INTO `carousel`(`carousel_img`, `carousel_carousel_name`) VALUES (?,?)";  //"INSERT INTO carousel (carousel_name, image, description, ) VALUES (?, ?, ?)"
//                 $stmt = $db->prepare($sql);
//                 if ($stmt) {
//                     $stmt->bind_param('ss', $carousel_carousel_name, $carousel_carousel_name);

//                     if ($stmt->execute()) {
//                         $response['status'] = 'success';
//                         $response['message'] = 'Team member added successfully';
//                     } else {
//                         $response['status'] = 'error';
//                         $response['message'] = 'Failed to save team member information to the database.';
//                     }

//                     $stmt->close();
//                 } else {
//                     $response['status'] = 'error';
//                     $response['message'] = 'Prepare statement failed: ' . $db->error;
//                 }

//                 $db->close();
//             }
//         }
//     } else {
//         $response['status'] = 'error';
//         $response['message'] = 'carousel_name or image not provided!';
//     }

//     // Capture any output generated during the script execution
//     $output = ob_get_clean();

//     // Check if there's any captured output
//     if (!empty($output)) {
//         $response['status'] = 'error';
//         $response['message'] = 'Unexpected output: ' . htmlspecialchars($output);
//     }

//     // Return JSON response
//     header('Content-Type: application/json');
//     echo json_encode($response);
// }

// if (isset($_POST['get_carousel'])) {
//     $res = selectAll('carousel');
//     $path = ABOUT_IMG_PATH;
//     while ($data = mysqli_fetch_assoc($res)) {
//         echo <<<HTML
//             <div class="card" style="width: 18rem;">
//                 <img src="$path{$data['carousel_img']}" class="card-img-top image-fluid" alt="{$data['carousel_name']}">
//                 <div class="card-body text-center">
//                     <h5 class="card-title">{$data['carousel_name']}</h5>
//                     <button type="button" class="btn btn-danger" onclick="remove_members($data[id])">
//                     <i class="bi bi-person-x"></i> Delete
//                     </button>
//                 </div>
//             </div>
//         HTML;
//     }
// }



// if (isset($_POST['remove_carousel'])) {
//     $frm_data = filtration($_POST);
//     $values = [$frm_data['remove_carousel']];  // Corrected to use the 'remove_carousel' key

//     $pre_q = "SELECT * FROM `carousel` WHERE `id`=?";
//     $res = select($pre_q, $values, 'i');
//     $img = mysqli_fetch_assoc($res);

//     if (deleteImages($img['image'], CAROUSEL_FOLDER)) {  // Corrected to use the 'image' key
//         $d = "DELETE FROM `carousel` WHERE `id`=?";
//         $res = delete($d, $values, 'i');
//         echo $res;
//     } else {
//         echo 0;
//     }
// }




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_carousel_image') {
    // Start output buffering to capture any potential errors
    ob_start();

    $response = ['status' => '', 'message' => ''];

    if (isset($_FILES['carousel_image']) && isset($_POST['carousel_name'])) {
        $carousel_name = $_POST['carousel_name'];
        $carousel_image = upload_carousel_image($_FILES['carousel_image'], CAROUSEL_FOLDER);

        if ($carousel_image == 'inv_img') {
            $response['status'] = 'error';
            $response['message'] = 'Invalid image type!';
        } else if ($carousel_image == 'inv_size') {
            $response['status'] = 'error';
            $response['message'] = 'Image size is too large!';
        } else if ($carousel_image == 'folder_creation_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Failed to create directory!';
        } else if ($carousel_image == 'upd_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Image upload failed!';
        } else {
            // Image uploaded successfully, now insert into database
            $server_name = "localhost";
            $user_name = "root";
            $password = "";
            $db_name = "vinayakhotel";

            $db = new mysqli($server_name, $user_name, $password, $db_name);

            if ($db->connect_error) {
                $response['status'] = 'error';
                $response['message'] = 'Connection failed: ' . $db->connect_error;
            } else {
                $sql = "INSERT INTO `carousel`(`carousel_img`, `carousel_name`) VALUES (?,?)";
                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('ss', $carousel_image, $carousel_name);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Carousel image added successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to save carousel image to the database.';
                    }

                    $stmt->close();
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Prepare statement failed: ' . $db->error;
                }

                $db->close();
            }
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Carousel name or image not provided!';
    }

    // Capture any output generated during the script execution
    $output = ob_get_clean();

    // Check if there's any captured output
    if (!empty($output)) {
        $response['status'] = 'error';
        $response['message'] = 'Unexpected output: ' . htmlspecialchars($output);
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_POST['get_carousel'])) {
    $res = selectAll('carousel');
    $path = CAROUSEL_IMAGE_PATH;
    while ($row = mysqli_fetch_assoc($res)) {
        $imagePath = $path . $row['carousel_img'];
        echo <<<HTML
            <div class="card" style="width: 18rem;">
                <img src="$imagePath" class="card-img-top image-fluid" alt="{$row['carousel_name']}">
                <div class="card-body text-center">
                    <h5 class="card-title">{$row['carousel_name']}</h5>
                    <button type="button" class="btn btn-danger" onclick="remove_carousel({$row['id']})">
                    <i class="bi bi-person-x"></i> Delete
                    </button>
                </div>
            </div>
        HTML;
    }
}

if (isset($_POST['remove_carousel'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['remove_carousel']];

    $pre_q = "SELECT * FROM `carousel` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (delete_carousel_image($img['carousel_img'], CAROUSEL_FOLDER)) {
        $d = "DELETE FROM `carousel` WHERE `id`=?";
        $res = delete($d, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}





?>