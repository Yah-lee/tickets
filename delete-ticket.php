<?php
// Include database connection
include('config.php');

// Start the session
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if the ticket ID is provided and if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticket_id'])) {
    // Sanitize the ticket ID
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);

    // Prepare a delete statement
    $sql = "DELETE FROM tickets WHERE id = '$ticket_id'";

    if (mysqli_query($conn, $sql)) {
        // Ticket deleted successfully
        header("location: ticket.php");
        exit;
    } else {
        // Error occurred while deleting the ticket
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If no ticket ID provided or method is not POST, redirect to the listing page
    header("location: ticket.php");
    exit;
}
?>
