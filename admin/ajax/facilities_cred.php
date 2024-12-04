<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_facilities') {
    ob_start();

    $response = ['status' => '', 'message' => ''];

    if (isset($_FILES['facilities_image']) && isset($_POST['facilities_name']) && isset($_POST['facilities_description'])) {
        $facilities_name = $_POST['facilities_name'];
        $facilities_image = upload_images($_FILES['facilities_image'], Facilities_FOLDER);
        $facilities_description = $_POST['facilities_description'];

        if ($facilities_image == 'inv_img' || $facilities_image == 'inv_size' || $facilities_image == 'folder_creation_failed' || $facilities_image == 'upd_failed') {
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
                $sql = "INSERT INTO `facilities`(`facilities_name`, `facilities_image`, `facilities_description`) VALUES (?, ?, ?)";
                $stmt = $db->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('sss', $facilities_name, $facilities_image, $facilities_description);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Facility added successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Failed to save facility information to the database.';
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

    $output = ob_get_clean();

    if (!empty($output)) {
        $response['status'] = 'error';
        $response['message'] = 'Unexpected output: ' . htmlspecialchars($output);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_POST['get_facilities'])) {
    $res = selectAll('facilities');
    $path = Facilities_IMAGE_PATH;
    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<HTML
            <tr>
                <td>$i</td>
                <td>{$data['facilities_name']}</td>
                <td><img src="{$path}{$data['facilities_image']}" alt="Facility Icon" style="width:50px;height:50px;"></td>
                <td>{$data['facilities_description']}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="remove_facilities({$data['id']})">
                    <i class="fa-solid fa-concierge-bell"></i> Delete
                    </button>
                </td>
            </tr>
        HTML;
        $i++;
    }
}

if (isset($_POST['remove_facilities'])) {
    $frm_data = filter_input(INPUT_POST, 'remove_facilities', FILTER_SANITIZE_NUMBER_INT);
    $values = [$frm_data];

    $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImages($img['facilities_image'], Facilities_FOLDER)) {
        $d = "DELETE FROM `facilities` WHERE `id`=?";
        $res = delete($d, $values, 'i');
        echo $res ? '1' : '0';
    } else {
        echo '0';
    }
}
?>