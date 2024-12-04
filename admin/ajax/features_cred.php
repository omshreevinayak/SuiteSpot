<?php
require ('../common/dbConfig.php');
require ('../common/essential.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_features') {
    $response = ['status' => '', 'message' => ''];

    if (isset($_POST['features_name'])) {
        $features_name = $_POST['features_name'];

        // Database connection details
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $db_name = "vinayakhotel";

        // Create connection
        $db = new mysqli($server_name, $user_name, $password, $db_name);

        // Check connection
        if ($db->connect_error) {
            $response['status'] = 'error';
            $response['message'] = 'Connection failed: ' . $db->connect_error;
        } else {
            // Prepare SQL statement
            $sql = "INSERT INTO `features`(`features_name`) VALUES (?)";
            $stmt = $db->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('s', $features_name);

                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'New features added successfully';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to add a new features to the database.';
                }

                $stmt->close();
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Prepare statement failed: ' . $db->error;
            }

            $db->close();
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'features name not provided!';
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

if (isset($_POST['get_features'])) {
    $res = selectAll('features');
    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<HTML
            <tr>
                <td>$i</td>
                <td>{$data['features_name']}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="remove_features({$data['id']})">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Delete
                    </button>
                </td>
            </tr>
        HTML;
        $i++;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_features'])) {
    $id = $_POST['remove_features'];

    // Database connection details
    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $db_name = "vinayakhotel";

    // Create connection
    $db = new mysqli($server_name, $user_name, $password, $db_name);

    // Check connection
    if ($db->connect_error) {
        echo 0; // Return error if connection fails
    } else {
        // Prepare SQL statement
        $sql = "DELETE FROM `features` WHERE `id` = ?";
        $stmt = $db->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                echo 1; // Return success if deletion is successful
            } else {
                echo 0; // Return error if deletion fails
            }

            $stmt->close();
        } else {
            echo 0; // Return error if prepare statement fails
        }

        $db->close();
    }
}






?>