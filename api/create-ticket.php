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
    if (!isset($ticketData["movie_title"]) || !isset($ticketData["screening_time"]) || !isset($ticketData["seat_number"])) {
        $response = array(
            'status' => 'error',
            'message' => 'All fields are required'
        );
    } else {
        // Extract ticket data from the decoded JSON
        $movieTitle = $ticketData["movie_title"];
        $screeningTime = $ticketData["screening_time"];
        $seatNumber = $ticketData["seat_number"];

        // Insert ticket into database
        $sql = "INSERT INTO tickets (movie_title, screening_time, seat_number) VALUES ('$movieTitle', '$screeningTime', '$seatNumber')";
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
