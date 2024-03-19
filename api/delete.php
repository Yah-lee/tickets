<?php
// Include your database connection file
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Check if ticket ID is provided in the POST request
    if (isset($_GET['id'])) {
        // Sanitize the input to prevent SQL injection
        $ticket_id = mysqli_real_escape_string($conn, $_GET['id']);

        // Delete the ticket from the database
        $sql = "DELETE FROM tickets WHERE id = $ticket_id";
        if (mysqli_query($conn, $sql)) {
            // If successful, return success message
            $response = array(
                'status' => 'success',
                'message' => 'Ticket deleted successfully'
            );
        } else {
            // If error, return error message
            $response = array(
                'status' => 'error',
                'message' => 'Error deleting ticket: ' . mysqli_error($conn)
            );
        }

        // Convert the response array to JSON format      
        $json_response = json_encode($response);

        // Set the content type header to application/json
        header('Content-Type: application/json');

        // Output the JSON response
        echo $json_response;
    } else {
        // If ticket ID is not provided in the POST request, return an error message
        $response = array(
            'status' => 'error',
            'message' => 'Ticket ID is required'
        );

        // Convert the response array to JSON format
        $json_response = json_encode($response);

        // Set the content type header to application/json
        header('Content-Type: application/json');

        // Output the JSON response
        echo $json_response;
    }
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
