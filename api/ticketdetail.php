<?php
// Include your database connection file
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');

    // Decode the JSON data to an associative array
    $ticketData = json_decode($data, true);

    // Retrieve data from the POST request
    $name = $ticketData["name"];
    $ticket_id = $ticketData["ticket_id"];
    $price = $ticketData["price"];

    // Insert ticket body into the database
    $sql = "INSERT INTO prices (name, ticket_id, price) VALUES ('$name', '$ticket_id', '$price')";
   
    if (mysqli_query($conn, $sql)) {
        $response = array(
            'status' => 'success',
            'message' => 'Ticket created successfully'
        );
    } else {
        $response = array(     
            'status' => 'error',
            'message' => 'Error creating ticket: ' . mysqli_error($conn)
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
