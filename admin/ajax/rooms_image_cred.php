<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'upload_room_image') {
        $response = ['status' => '', 'message' => ''];

        // Debugging logs
        error_log("FILES: " . print_r($_FILES, true));
        error_log("POST: " . print_r($_POST, true));

        if (isset($_FILES['room_image'])) { // Changed 'room_images' to 'room_image'
            $room_image = upload_room_images($_FILES['room_image'], ROOM_FOLDER); // Ensure folder name is correct
            $room_images_id = $_POST['room_id'];

            if ($room_image == 'inv_img' || $room_image == 'inv_size' || $room_image == 'upd_failed') {
                $response['status'] = 'error';
                $response['message'] = 'Image upload failed!';
            } else {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vinayakhotel";

                $db = new mysqli($servername, $username, $password, $dbname);

                if ($db->connect_error) {
                    $response['status'] = 'error';
                    $response['message'] = 'Connection failed: ' . $db->connect_error;
                } else {
                    // Check for duplicate
                    $check_sql = "SELECT COUNT(*) FROM `rooms_image` WHERE `room_images` = ?";
                    $check_stmt = $db->prepare($check_sql);
                    $check_stmt->bind_param('s', $room_image);
                    $check_stmt->execute();
                    $check_stmt->bind_result($count);
                    $check_stmt->fetch();
                    $check_stmt->close();

                    if ($count > 0) {
                        $response['status'] = 'success';
                        $response['message'] = 'Image uploaded successfully';
                    } else {
                        $sql = "INSERT INTO `rooms_image`(`room_images_id`, `room_images`) VALUES (?, ?)";
                        $stmt = $db->prepare($sql);
                        if ($stmt) {
                            $stmt->bind_param('is', $room_images_id, $room_image);

                            if ($stmt->execute()) {
                                $response['status'] = 'success';
                                $response['message'] = 'Image uploaded successfully';
                            } else {
                                $response['status'] = 'error';
                                $response['message'] = 'Failed to save image information to the database.';
                            }

                            $stmt->close();
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'Prepare statement failed: ' . $db->error;
                        }
                    }

                    $db->close();
                }
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No image provided!';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    if (isset($_POST['get_rooms_all_image'])) {
        $room_images_id = $_POST['get_rooms_all_image'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vinayakhotel";

        $db = new mysqli($servername, $username, $password, $dbname);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $sql = "SELECT * FROM `rooms_image` WHERE `room_images_id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $room_images_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $path = ROOMS_IMAGE_PATH;
        $html_output = '';
        while ($row = $result->fetch_assoc()) {
            $room_images = $row['room_images'];
            if ($row['room_images_thumb'] == 1) {
                $thumb_btn = "<button type='button' class='btn text-success'><svg xmlns='http://www.w3.org/2000/svg' width='34' height='34' fill='currentColor' class='bi bi-check2-circle' viewBox='0 0 16 16'>
    <path d='M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0'/>
    <path d='M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
    </svg>
    Your Current Thumbnail
    </button>";
            } else {
                $thumb_btn = "<button type='button' onclick='thumb_image({$row['id']}, {$row['room_images_id']})' class='btn text-secondary shadow-none'><svg xmlns='http://www.w3.org/2000/svg' width='34' height='34' fill='currentColor' class='bi bi-check2-circle' viewBox='0 0 16 16'>
    <path d='M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0'/>
    <path d='M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'/>
    </svg>
    Set as Thumbnail
    </button>";
            }

            $html_output .= <<<data
            <tr class='align-middle'>
                <td class='text-center'><img src="{$path}{$room_images}" class="card-img-top img-fluid" style="width:300px;"></td>
                <td class='text-center'>$thumb_btn</td>
                <td class='text-center'>
                    <button type='button' onclick='remove_room_image($row[id], $row[room_images_id])' class='btn text-danger text-middle'><svg xmlns='http://www.w3.org/2000/svg' width='34' height='34' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                    <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                    </svg>
                    Delete</button>
                </td>
            </tr>
            data;
        }

        $stmt->close();
        $db->close();

        echo $html_output;
    }
}


if (isset($_POST['remove_room_image'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['rooms_image_id'], $frm_data['room_id']]; // Ensure correct keys

    // Log received data for debugging
    error_log("Received data: " . print_r($values, true));

    // Fetch the image data
    $pre_q = "SELECT * FROM `rooms_image` WHERE `id`=? AND `room_images_id`=?";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    // Log if no image is found
    if (!$img) {
        error_log("Image not found in the database.");
        echo '0';
        exit;
    }

    // Log fetched image data for debugging
    error_log("Fetched image data: " . print_r($img, true));

    // Attempt to delete the image file from the server
    if (delete_room_images($img['room_images'], ROOM_FOLDER)) {
        $d = "DELETE FROM `rooms_image` WHERE `id`=? AND `room_images_id`=?";
        $res = delete($d, $values, 'ii');

        // Log the result of the delete query
        if ($res) {
            error_log("Image deleted from the database.");
            echo '1';
        } else {
            error_log("Failed to delete image from the database.");
            echo '0';
        }
    } else {
        error_log("Failed to delete image file from the server.");
        echo '0';
    }
}


if (isset($_POST['thumb_image'])) {
    $frm_data = filtration($_POST);

    // First, reset the current thumbnail
    $pre_q = "UPDATE `rooms_image` SET `room_images_thumb`=? WHERE `room_images_id`=?";
    $pre_v = [0, $frm_data['room_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');

    // Set the new thumbnail
    $q = "UPDATE `rooms_image` SET `room_images_thumb`=? WHERE `id`=? AND `room_images_id`=?";
    $v = [1, $frm_data['rooms_image_id'], $frm_data['room_id']];
    $res = update($q, $v, 'iii');

    echo $res ? '1' : '0';
}

// Define your helper functions (ensure these are included in your script)
// function filtration($data) {
//     // Sanitize input data
//     foreach ($data as $key => $value) {
//         $data[$key] = htmlspecialchars(strip_tags($value));
//     }
//     return $data;
// }

// function update($query, $params, $types)
// {
//     global $conn; // Assuming $conn is your database connection
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param($types, ...$params);
//     return $stmt->execute();
// }



function delete_rooms_images($image_name, $folder)
{
    $file_path = $folder . $image_name;
    return unlink($file_path); // Deletes the file
}



// if (isset($_POST['get_rooms_all_image'])) {
//     $frm_data = filtration($_POST);
//     $res = select("SELECT * FROM `room_images` WHERE `room_images_id`=?", [$frm_data['get_rooms_all_image']], 'i');

//     $path = ROOMS_IMAGE_PATH;
//     while ($row = mysqli_fetch_assoc($res)) {
//         echo <<<data
//         <tr>
//             <td><img src="$path$room_images" class="card-img-top image-fluid"></td>
//             <td>Thumb</td>
//             <td>Delete</td>
//         </tr>
//         data;
//     }
// }


// if (isset($_POST['get_rooms_all_image'])) {
//     $frm_data = filtration($_POST);
//     $room_images_id = $frm_data['get_rooms_all_image'];

//     // Database connection
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "vinayakhotel";

//     $db = new mysqli($servername, $username, $password, $dbname);

//     if ($db->connect_error) {
//         die("Connection failed: " . $db->connect_error);
//     }

//     // Query the correct table
//     $sql = "SELECT * FROM `rooms_image` WHERE `room_images_id`=?";
//     $stmt = $db->prepare($sql);
//     if ($stmt === false) {
//         die("Prepare failed: " . $db->error);
//     }
//     $stmt->bind_param('i', $room_images_id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $path = ROOMS_IMAGE_PATH;
//     while ($row = $result->fetch_assoc()) {
//         $room_images = $row['room_images'];
//         echo <<<data
//         <tr>
//             <td><img src="$path$room_images" class="card-img-top img-fluid"></td>
//             <td>Thumb</td>
//             <td>Delete</td>
//         </tr>
//         data;
//     }

//     $stmt->close();
//     $db->close();
// }

?>