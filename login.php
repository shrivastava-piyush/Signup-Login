<?php

require_once 'include/DB_Utils.php';
$db = new DB_Utils();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $db->getUserByEmailAndPassword($email, $password);

    if ($user != false) {
        // user is found
        $response["error"] = FALSE;
        $response["uid"] = $user["unique_id"];
        $response["user"]["name"] = $user["name"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["created_at"] = $user["created_at"];
        $response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);
    } else {
        // Incorrect credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Your credentials are incorrect. Please try again.";
        echo json_encode($response);
    }
} else {
    // post params are missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Email or password is missing. Please try again.";
    echo json_encode($response);
}
?>

