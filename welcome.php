<?php
include('header.php');

// Start the session
session_start();

// Function to view available seats for a particular movie screening
function viewAvailableSeats($movieTitle, $screeningTime) {
    global $conn;
    $sql = "SELECT seat_number FROM tickets WHERE movie_title = '$movieTitle' AND screening_time = '$screeningTime' AND booked_by IS NULL";
    $result = mysqli_query($conn, $sql);
    $availableSeats = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $availableSeats[] = $row['seat_number'];
    }
    return $availableSeats;
}

// Function to book a ticket
function bookTicket($movieTitle, $screeningTime, $seatNumber, $bookedBy) {
    global $conn;
    $sql = "UPDATE tickets SET booked_by = '$bookedBy' WHERE movie_title = '$movieTitle' AND screening_time = '$screeningTime' AND seat_number = $seatNumber AND booked_by IS NULL";
    return mysqli_query($conn, $sql);
}

// Function to view booked tickets for a particular user
function viewBookedTickets($bookedBy) {
    global $conn;
    $sql = "SELECT * FROM tickets WHERE booked_by = '$bookedBy'";
    $result = mysqli_query($conn, $sql);
    $bookedTickets = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $bookedTickets[] = $row;
    }
    return $bookedTickets;
}

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Handle form submission for booking a ticket
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieTitle = $_POST["movie_title"];
    $screeningTime = $_POST["screening_time"];
    $seatNumberToBook = $_POST["seat_number"];
    $userName = $_SESSION["username"];

    if (in_array($seatNumberToBook, viewAvailableSeats($movieTitle, $screeningTime))) {
        if (bookTicket($movieTitle, $screeningTime, $seatNumberToBook, $userName)) {
            $bookingStatus = "Ticket booked successfully!";
        } else {
            $bookingStatus = "Failed to book ticket.";
        }
    } else {
        $bookingStatus = "Seat is not available.";
    }
}

?>
<div>



</div>

</body>

</html>