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
        exit;
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div>

    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">Book Tickets</h2>
            <form action="process-booking.php" method="post">
                <div class="mb-4">
                    <label for="movie" class="block text-gray-700 text-sm font-bold mb-2">Select Movie</label>
                    <select name="movie" id="movie" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400">
                        <?php
                        // Fetch movies from the database
                        $sql = "SELECT * FROM tickets";
                        $result = mysqli_query($conn, $sql);

                        // Check if there are any movies
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through each row to display movie options
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['movie_title'] . "</option>";
                            }
                        } else {
                            // No movies found
                            echo "<option value=''>No movies available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="seats" class="block text-gray-700 text-sm font-bold mb-2">Number of Seats</label>
                    <input type="number" name="seats" id="seats" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Book Now</button>
                </div>
            </form>
        </div>
    </div>

</div>

</body>

</html>