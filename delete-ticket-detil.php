<?php
// Include database connection
include('config.php');
// Check if the ticket ID is provided and if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $priceId = $_GET['id'];
    $mainId = $_GET['main_id'];

    // Prepare a delete statement
    $sql = "DELETE FROM prices WHERE id = '$priceId'";

    if (mysqli_query($conn, $sql)) {
        // Ticket deleted successfully
        header("location: ticket-detail.php?id=".$mainId);
        exit;
    } else {
        // Error occurred while deleting the ticket
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If no ticket ID provided or method is not POST, redirect to the listing page
    // header("location: ticket.php");
    // exit;
}
?>
