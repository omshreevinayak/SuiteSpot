<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add_rooms') {
        $features = json_decode($_POST['features'], true);
        $facilities = json_decode($_POST['facilities'], true);
        $frm_data = $_POST;
        $flag = 0;

        $q1 = "INSERT INTO `rooms`(`rooms_name`, `rooms_area`, `rooms_guest_adult`, `rooms_guest_children`, `rooms_price`, `rooms_quantity`, `room_description`) VALUES (?,?,?,?,?,?,?)";
        $values1 = [$frm_data['rooms_name'], $frm_data['rooms_area'], $frm_data['rooms_guest_adult'], $frm_data['rooms_guest_children'], $frm_data['rooms_price'], $frm_data['rooms_quantity'], $frm_data['room_description']];
        if (insert($q1, $values1, 'siiiiis')) {
            $flag = 1;
            $room_id = mysqli_insert_id($con);

            $q2 = "INSERT INTO `room_facility`(`rooms_id`, `facilities_id`) VALUES (?,?)";
            if ($stmt = mysqli_prepare($con, $q2)) {
                foreach ($facilities as $f) {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                $flag = 0;
            }

            $q3 = "INSERT INTO `room_feature`(`rooms_id`, `features_id`) VALUES (?,?)";
            if ($stmt = mysqli_prepare($con, $q3)) {
                foreach ($features as $f) {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                $flag = 0;
            }
        }

        echo $flag ? '1' : '0';
    } elseif ($_POST['action'] === 'get_all_rooms') {
        $res = selectAll('rooms');
        $i = 1; // Start from 1 for the serial number
        $data = "";

        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['rooms_status'] == 1) {
                $status = "<button type='button' onclick='toggleBtn({$row['id']}, 0)' class='btn badge btn-success'>Active</button>";
            } else {
                $status = "<button type='button' onclick='toggleBtn({$row['id']}, 1)' class='btn badge btn-danger'>Inactive</button>";
            }

            // $data .= "
            // <tr class='text-center'>
            //     <td class='text-center'>$i</td>
            //     <td class='text-center'>$row[rooms_name]</td>
            //     <td class='text-center'>$row[rooms_area] sq/ft</td>
            //     <td>
            //         <span class='badge rounded-pills bg-light text-dark'>Adults : {$row['rooms_guest_adult']}</span>
            //     </td>
            //     <td>
            //         <span class='badge rounded-pills bg-light text-dark'>Children : {$row['rooms_guest_children']}</span>
            //     </td>
            //     <td class='text-center'>₹ $row[rooms_price]</td>
            //     <td class='text-center'>$row[rooms_quantity]</td>
            //     <td class='text-center'>$status</td>
            //     <td class='text-center'>
            //         <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#editRoom_modal' onclick='edit_room($row[id])'><i class='fa-solid fa-file-pen'></i></button>
            //     </td>
            // </tr>
            // ";
            // $i++;
        }
        echo $data;

    }  /*<td>$row[room_description]</td>*/
}


if (isset($_POST['edit_room'])) {
    $frm_data = filtration($_POST);

    // Perform select queries
    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['edit_room']], 'i');
    $res2 = select("SELECT features_id FROM `room_feature` WHERE `rooms_id`=?", [$frm_data['edit_room']], 'i');
    $res3 = select("SELECT facilities_id FROM `room_facility` WHERE `rooms_id`=?", [$frm_data['edit_room']], 'i');

    // Fetch results and check if they are not null
    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];

    // Fetch all features related to the room
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $features[] = $row2['features_id'];
    }

    // Fetch all facilities related to the room
    while ($row3 = mysqli_fetch_assoc($res3)) {
        $facilities[] = $row3['facilities_id'];
    }

    // Initialize data array
    $data = ["roomdata" => $roomdata, "features" => $features, "facilities" => $facilities];

    // Encode data to JSON and send it to client
    echo json_encode($data);
}


if (isset($_POST['action'])) {
    if ($_POST['action'] === 'edit_rooms_form') {
        $features = json_decode($_POST['features'], true);
        $facilities = json_decode($_POST['facilities'], true);
        $frm_data = $_POST;
        $flag = 0;

        $q1 = "UPDATE `rooms` SET `rooms_name`=?, `rooms_area`=?, `rooms_guest_adult`=?, `rooms_guest_children`=?, `rooms_price`=?, `rooms_quantity`=?, `room_description`=? WHERE `id`=?";
        $values1 = [$frm_data['rooms_name'], $frm_data['rooms_area'], $frm_data['rooms_guest_adult'], $frm_data['rooms_guest_children'], $frm_data['rooms_price'], $frm_data['rooms_quantity'], $frm_data['room_description'], $frm_data['room_id']];

        if (insert($q1, $values1, 'siiiiisi')) {
            $flag = 1;
            $room_id = $frm_data['room_id'];

            // Update facilities
            $q2 = "DELETE FROM `room_facility` WHERE `rooms_id`=?";
            if ($stmt = mysqli_prepare($con, $q2)) {
                mysqli_stmt_bind_param($stmt, 'i', $room_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            $q2 = "INSERT INTO `room_facility` (`rooms_id`, `facilities_id`) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($con, $q2)) {
                foreach ($facilities as $f) {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                $flag = 0;
            }

            // Update features
            $q3 = "DELETE FROM `room_feature` WHERE `rooms_id`=?";
            if ($stmt = mysqli_prepare($con, $q3)) {
                mysqli_stmt_bind_param($stmt, 'i', $room_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            $q3 = "INSERT INTO `room_feature` (`rooms_id`, `features_id`) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($con, $q3)) {
                foreach ($features as $f) {
                    mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                $flag = 0;
            }
        }

        echo $flag ? '1' : '0';
    } elseif ($_POST['action'] === 'get_all_rooms') {
        $res = selectAll('rooms');
        $i = 1; // Start from 1 for the serial number
        $data = "";

        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['rooms_status'] == 1) {
                $status = "<button type='button' onclick='toggleBtn({$row['id']}, 0)' class='btn badge btn-success'>Active</button>";
            } else {
                $status = "<button type='button' onclick='toggleBtn({$row['id']}, 1)' class='btn badge btn-danger'>Inactive</button>";
            }

            $data .= "
            <tr class='text-center' data-room-id='{$row['id']}'>
                <td class='text-center'>$i</td>
                <td class='text-center'>$row[rooms_name]</td>
                <td class='text-center'>$row[rooms_area] sq/ft</td>
                <td>
                    <span class='badge rounded-pills bg-light text-dark'>Adults : {$row['rooms_guest_adult']}</span>
                </td>
                <td>
                    <span class='badge rounded-pills bg-light text-dark'>Children : {$row['rooms_guest_children']}</span>
                </td>
                <td class='text-center'>₹ $row[rooms_price]</td>
                <td class='text-center'>$row[rooms_quantity]</td>
                <td class='text-center'>$status</td>
                <td class='text-center'>
                    <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#editRoom_modal' onclick='edit_room($row[id])' style='margin-left:1.5rem;'><i class='fa-solid fa-file-pen'></i></button>
                </td>
                <td class='text-center'>
                    <button type='button' class='btn' data-bs-toggle='modal' data-bs-target='#room_img_modal' onclick=\"room_image($row[id],'$row[rooms_name]')\" style='margin-left:1rem;'><i class='fa-solid fa-image'></i></button>
                </td>
            </tr>
            ";
            $i++;
        }
        echo $data;
    } elseif ($_POST['action'] === 'get_room_by_id') {
        $room_id = $_POST['room_id'];
        $res = select("SELECT * FROM rooms WHERE id=?", [$room_id], 'i');
        $room = mysqli_fetch_assoc($res);

        $features = select("SELECT features_id FROM room_feature WHERE rooms_id=?", [$room_id], 'i');
        $facilities = select("SELECT facilities_id FROM room_facility WHERE rooms_id=?", [$room_id], 'i');

        $room['features'] = array_column($features, 'features_id');
        $room['facilities'] = array_column($facilities, 'facilities_id');

        echo json_encode($room);
    }
}

// Start output buffering to capture any potential errors
ob_start();

$response = ['status' => '', 'message' => ''];

// Check if the request method is POST and if the action is 'upload_room_image'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_room_image') {
    if (isset($_FILES['room_images']) && isset($_POST['room_id'])) {
        $room_images = upload_room_image($_FILES['room_images'], ROOMS_FOLDER);

        if ($room_images == 'inv_img') {
            $response['status'] = 'error';
            $response['message'] = 'Invalid image type!';
        } else if ($room_images == 'inv_size') {
            $response['status'] = 'error';
            $response['message'] = 'Image size is too large!';
        } else if ($room_images == 'folder_creation_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Failed to create directory!';
        } else if ($room_images == 'upd_failed') {
            $response['status'] = 'error';
            $response['message'] = 'Image upload failed!';
        } else {
            // Image uploaded successfully, now insert into the database
            $server_name = "localhost";
            $user_name = "root";
            $password = "";
            $db_name = "vinayakhotel";

            $db = new mysqli($server_name, $user_name, $password, $db_name);

            if ($db->connect_error) {
                $response['status'] = 'error';
                $response['message'] = 'Connection failed: ' . $db->connect_error;
            } else {
                $room_id = intval($_POST['room_id']); // Get room_id from POST data and ensure it's an integer
                $sql = "INSERT INTO `rooms_image` (`room_images_id`, `room_images`) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('is', $room_id, $room_images);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Room image added successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to save room image to the database.';
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
        $response['message'] = 'Room ID or image not provided!';
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

// Function to handle image upload
function upload_room_image($image, $folder)
{
    $valid_mime = ['image/jpg', 'image/png', 'image/jpeg', 'image/webp', 'image/heic'];
    $img_mime = $image['type'];

    // Validate image MIME type
    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }

    // Validate image size (greater than 10MB)
    if ($image['size'] / (1024 * 1024) > 10) {
        return 'inv_size';
    }

    $extract_img = pathinfo($image['name'], PATHINFO_EXTENSION);
    $serial_number = time();
    $new_img_name = 'img_' . $serial_number . '.' . $extract_img;

    // Ensure the folder path ends with a slash
    if (substr($folder, -1) !== '/') {
        $folder .= '/';
    }

    $upload_path = $folder . $new_img_name;

    // Create the directory if it doesn't exist
    if (!is_dir($folder) && !mkdir($folder, 0777, true)) {
        return 'folder_creation_failed';
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $upload_path)) {
        return $new_img_name;
    } else {
        return 'upd_failed';
    }
}

if (isset($_POST['toggleBtn'])) {
    $frm_data = filtration($_POST);
    $upd = "UPDATE `rooms` SET `rooms_status`=? WHERE `id`=?";
    $val = [$frm_data['value'], $frm_data['toggleBtn']];
    if (update($upd, $val, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}
?>