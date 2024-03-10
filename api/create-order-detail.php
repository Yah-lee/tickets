<?php
// Include your database connection file
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the raw POST data
    $data = file_get_contents('php://input');

    // Decode the JSON data to an associative array
    $ticketData = json_decode($data, true);

    // Check if all required fields are present
    if (!isset($ticketData["ticket_id"]) || !isset($ticketData["price_id"]) || !isset($ticketData["price_type"])) {
        $response = array(
            'status' => 'error',
            'message' => 'All fields are required'
        );
    } else {
        // Extract ticket data from the decoded JSON
        $ticketId = $ticketData["ticket_id"];
        $priceId = $ticketData["price_id"];
        $priceType = $ticketData["price_type"];

        // Insert ticket into database
        $sql = "INSERT INTO order_detail (ticket_id, price_id, price_type) VALUES ('$ticketId', '$priceId', '$priceType')";
        $udpateTicket = "UPDATE `tickets` SET `booked_number` = booked_number + 1 WHERE `tickets`.`id` = '$ticketId'";
        mysqli_query($conn, $udpateTicket);
        if (mysqli_query($conn, $sql)) {
            $inserted_id = mysqli_insert_id($conn);
            $response = array(
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'inserted_id' => $inserted_id
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error creating ticket: ' . mysqli_error($conn)
            );
        }
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
// Close the database connection

mysqli_close($conn);
