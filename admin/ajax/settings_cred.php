<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();


if (isset($_POST['get_general'])) {
    $q = "SELECT * FROM `setting` WHERE `id`=?";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['update_general'])) {
    $frm_data = filtration($_POST);
    $upd = "UPDATE `setting` SET `site_title`=?,`site_description`=? WHERE `id`=?";
    $values = [$frm_data['site_title'], $frm_data['site_description'], 1];
    $res = update($upd, $values, "ssi");
    echo $res;
}

if (isset($_POST['upd_shutdown'])) {
    $frm_data = ($_POST['upd_shutdown'] == 0) ? 1 : 0;
    $upd = "UPDATE `setting` SET `shutdown`=? WHERE `id`=?";
    $values = [$frm_data, 1];
    $res = update($upd, $values, "ii");
    echo $res;
}

if (isset($_POST['get_contact'])) {
    $q = "SELECT * FROM `contact_detail` WHERE `id`=?";
    $values = [1];
    $res = select($q, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['upd_contacts'])) {
    $frm_data = filtration($_POST);
    $q = "UPDATE `contact_detail` SET `hotel_address`=?,`hotel_map`=?,`contactNumber_1`=?,`contactNumber_2`=?,`hotel_mail`=?,`insta_link`=?,`meta_link`=?,`twitter_link`=?,`youtube_link`=?,`iframe_link`=? WHERE `id`=?";
    $values = [
        $frm_data['hotel_address'],
        $frm_data['hotel_map'],
        $frm_data['contactNumber_1'],
        $frm_data['contactNumber_2'],
        $frm_data['hotel_mail'],
        $frm_data['insta_link'],
        $frm_data['meta_link'],
        $frm_data['twitter_link'],
        $frm_data['youtube_link'],
        $frm_data['iframe_link'],
        1
    ];
    $res = select($q, $values, "ssssssssssi");
    echo ($res) ? 1 : 0; // echo 1 for success, 0 for failure
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_team_member') {
    // Start output buffering to capture any potential errors
    ob_start();

    $response = ['status' => '', 'message' => ''];

    if (isset($_FILES['member_image']) && isset($_POST['member_name']) && isset($_POST['member_description']) && isset($_POST['member_insta']) && isset($_POST['member_facebook']) && isset($_POST['member_mail'])) {
        $member_name = $_POST['member_name'];
        $image_name = upload_images($_FILES['member_image'], ABOUT_FOLDER);
        $member_description = $_POST['member_description'];
        $member_insta = $_POST['member_insta'];
        $member_facebook = $_POST['member_facebook'];
        $member_mail = $_POST['member_mail'];

        if ($image_name == 'inv_img') {
            $response['status'] = 'error';
            $response['message'] = 'Invalid image type!';
        } else if ($image_name == 'inv_size') {
            $response['status'] = 'error';
            $response['message'] = 'Image size is too large!';
        } else if ($image_name == 'folder_creation_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Failed to create directory!';
        } else if ($image_name == 'upd_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Image upload failed!';
        } else {
            // Image uploaded successfully, now insert into database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "vinayakhotel";

            $db = new mysqli($servername, $username, $password, $dbname);

            if ($db->connect_error) {
                $response['status'] = 'error';
                $response['message'] = 'Connection failed: ' . $db->connect_error;
            } else {
                $sql = "INSERT INTO `management_details`(name, image, description, member_insta, member_facebook, member_mail) VALUES (?, ?, ?, ?, ?, ?)";  //"INSERT INTO management_details (name, image, description, ) VALUES (?, ?, ?)"
                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('ssssss', $member_name, $image_name, $member_description, $member_insta, $member_facebook, $member_mail);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Team member added successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to save team member information to the database.';
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
        $response['message'] = 'Name or image not provided!';
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

if (isset($_POST['get_members'])) {
    $res = selectAll('management_details');
    $path = ABOUT_IMG_PATH;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<HTML
            <div class="card" style="width: 18rem;">
                <img src="$path{$data['image']}" class="card-img-top image-fluid" alt="{$data['name']}">
                <div class="card-body text-center">
                    <h5 class="card-title">{$data['name']}</h5>
                    <p class="card-text">{$data['description']}</p>
                    <button type="button" class="btn btn-danger" onclick="remove_members({$data['id']})">
                    <i class="bi bi-person-x"></i> Delete
                    </button>
                </div>
            </div>
        HTML;
    }
}






if (isset($_POST['remove_members'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['remove_members']];  // Corrected to use the 'remove_members' key

    $pre_q = "SELECT * FROM `management_details` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImages($img['image'], ABOUT_FOLDER)) {  // Corrected to use the 'image' key
        $d = "DELETE FROM `management_details` WHERE `id`=?";
        $res = delete($d, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}


// if (isset($_POST['remove_members'])) {
//     $frm_data = filtration($_POST);
//     $values = [$frm_data];

//     $pre_q = "SELECT * FROM `management_details` WHERE `id`=?";
//     $res = select($pre_q, $values, 'i');
//     $img = mysqli_fetch_assoc($res);

//     if (deleteImages($img, ABOUT_FOLDER)) {
//         $d = "DELETE FROM `management_details` WHERE `id`=?";
//         $res = delete($d, $values, 'i');
//         echo $res;
//     } else {
//         echo 0;
//     }
// }

// if (isset($_POST['remove_members'])) {
//     error_log("remove_members POST data received"); // Debugging line
//     $frm_data = filtration($_POST);
//     $values = [$frm_data['remove_members']];

//     // Debugging line
//     error_log("Received POST data: " . print_r($frm_data, true));

//     $pre_q = "SELECT * FROM `management_details` WHERE `id`=?";
//     $res = select($pre_q, $values, 'i');

//     // Debugging line
//     error_log("Select query result: " . print_r($res, true));

//     if ($res && delete_images($res['image'], ABOUT_FOLDER)) {
//         $q = "DELETE FROM `management_details` WHERE `id`=?";
//         $delete_res = delete($q, $values, 'i');
//         echo $delete_res ? 1 : 0;
//         error_log("Delete query result: " . $delete_res); // Debugging line
//     } else {
//         echo 0;
//         error_log("Failed to delete image or record"); // Debugging line
//     }
// }


// if (isset($_POST['remove_members'])) {
//     $id = $_POST['remove_members'];

//     // Database connection
//     $conn = new mysqli('localhost', 'username', 'password', 'database');

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Delete query
//     $sql = "DELETE FROM management_details WHERE id = $id";

//     if ($conn->query($sql) === TRUE) {
//         echo "1";
//     } else {
//         echo "Error deleting record: " . $conn->error;
//     }

//     $conn->close();
// }




?>