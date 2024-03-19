<?php
// Include your database connection file
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $user_id = $_POST["user_id"]; // Assuming you have user authentication in place
    $ticket_id = $_POST["ticket_id"]; // ID of the ticket being ordered
    $quantity = $_POST["quantity"]; // Quantity of tickets being ordered

    // Insert order details into the database
    $sql = "INSERT INTO orders (user_id, ticket_id, quantity) VALUES ('$user_id', '$ticket_id', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        // If successful, return success message
        $response = array(
            'status' => 'success',
            'message' => 'Order placed successfully'
        );
    } else {
        // If error, return error message
        $response = array(
            'status' => 'error',
            'message' => 'Error placing order: ' . mysqli_error($conn)
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
