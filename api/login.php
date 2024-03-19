<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');
    $postData = json_decode($data, true);
    
    $username = $postData["username"];
    $password = $postData["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $response = array(
            'status' => 'success',
            'message' => 'Login successful'
        );
    } else {      
        $response = array(
            'status' => 'error',
            'message' => 'Invalid username or password'
        );
    }

    $json_response = json_encode($response);
    header('Content-Type: application/json');
    echo $json_response;
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method'
    );
    $json_response = json_encode($response);
    header('Content-Type: application/json');
    echo $json_response;
}
mysqli_close($conn);
