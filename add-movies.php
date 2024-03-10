<?php
include('header.php');
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $release_date = $_POST["release_date"];
    $duration = $_POST["duration"];

    // Insert movie details into the database
    $sql = "INSERT INTO movies (title, description, release_date, duration) VALUES ('$title', '$description', '$release_date', '$duration')";
    if (mysqli_query($conn, $sql)) {
        $message = "Movie added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div>

    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">
            <h2 class="text-2xl font-bold mb-4">Add Movies</h2>
            <form action="add-movies.php" method="post">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description" rows="3" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400"></textarea>
                </div>
                <div class="mb-4">
                    <label for="release_date" class="block text-gray-700 text-sm font-bold mb-2">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400">
                </div>
                <div class="mb-4">
                    <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">Duration (in minutes)</label>
                    <input type="number" name="duration" id="duration" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add Movie</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>