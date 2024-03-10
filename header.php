<?php
// Start the session
include('config.php');
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Ticket Booking</title>
    <!-- Your CSS stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo or Brand Name -->
            <a href="welcome.php" class="text-xl font-bold">Your Cinema Name</a>

            <!-- Navigation Links -->
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="ticket.php">Tickets</a></li>
                    <li><a href="booking-ticket.php">Book Tickets</a></li>
                </ul>
            </nav>

            <div>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
