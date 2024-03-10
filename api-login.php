<?php
// Include your database connection file
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the POST data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to select user from the database based on username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $response = array(
                'status' => 'success',
                'message' => 'Login successful',
                'user_id' => $user['id'],
                'username' => $user['username']
            );
        } else {
            // Password is incorrect
            $response = array(
                'status' => 'error',
                'message' => 'Incorrect password'
            );
        }
    } else {
        // User does not exist
        $response = array(
            'status' => 'error',
            'message' => 'User not found'
        );
    }

    // Convert the response array to JSON format
    $json_response = json_encode($response);

    // Set the content type header to application/json
    header('Content-Type: application/json');

    // Output the JSON response
    echo $json_response;
} else {
    // If the request method is not POST, return an error message
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method'
    );

    // Convert the response array to JSON format
    $json_response = json_encode($response);

    // Set the content type header to application/json
    header('Content-Type: application/json');

    // Output the JSON response
    echo $json_response;
}

// Close the database connection
mysqli_close($conn);
?>
