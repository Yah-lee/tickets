<?php
include('header.php');
include('config.php');


$movieTitle = $screeningTime = $seatNumber = $message = '';

// Handle form submission for adding a new ticket
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $movieTitle = $_POST["movie_title"];
    $screeningTime = $_POST["screening_time"];
    $seatNumber = $_POST["seat_number"];

    // Insert ticket into database
    $sql = "INSERT INTO tickets (movie_title, screening_time, seat_number) VALUES ('$movieTitle', '$screeningTime', '$seatNumber')";
    if (mysqli_query($conn, $sql)) {
        $message = "New ticket added successfully!";
        header("location: ticket.php");
        exit;
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div>


    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-bold mb-4">Add New Ticket</h2>

        <!-- Form to add a new ticket -->
        <form method="post" class="w-64" action="add-ticket.php">
            <label for="movie_title" class="block text-gray-700 text-sm font-bold mb-2">Movie Title</label>
            <input type="text" id="movie_title" name="movie_title" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" required>

            <label for="screening_time" class="block mt-2 text-gray-700 text-sm font-bold mb-2">Screening Time</label>
            <input type="datetime-local" id="screening_time" name="screening_time" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" required>

            <label for="seat_number" class="block mt-2 text-gray-700 text-sm font-bold mb-2">Seat Number</label>
            <input type="number" id="seat_number" name="seat_number" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 mt-4">Add Ticket</button>
        </form>
    </div>
</div>
<script>


</script>

</body>

</html>