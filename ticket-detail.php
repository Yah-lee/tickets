<?php
include('header.php');
include('config.php');


$id = $_GET['id'];
$sql = "SELECT * FROM tickets where id = '$id'";
$result = mysqli_query($conn, $sql);

// Check if there are any tickets
if (mysqli_num_rows($result) > 0) {
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $tickets = [];
}

$sqlPrice = "SELECT * FROM prices where ticket_id = '$id'";
$resultPrice = mysqli_query($conn, $sqlPrice);

// Check if there are any tickets
if (mysqli_num_rows($resultPrice) > 0) {
    $prices = mysqli_fetch_all($resultPrice, MYSQLI_ASSOC);
} else {
    $prices = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $price = $_POST["price"];
    $ticketId =  $_POST['ticket_id'];

    // Insert ticket into database
    $sql = "INSERT INTO prices (name,ticket_id,price) VALUES ('$name', '$ticketId', '$price')";
    if (mysqli_query($conn, $sql)) {
        $message = "New ticket added successfully!";
        header("location: ticket-detail.php?id=" . $ticketId);
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div>

    <div class="container mx-auto mt-4">

        <!-- Display tickets in a table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-4 py-2">Movie Title</th>
                        <th class="px-4 py-2">Screening Time</th>
                        <th class="px-4 py-2">Seat Number</th>
                        <th class="px-4 py-2">Booked By</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through tickets data and display in rows -->
                    <?php foreach ($tickets as $ticket) : ?>
                        <tr class="bg-gray-100">
                            <td class="border px-4 py-2"><?php echo $ticket['movie_title']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['screening_time']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['seat_number']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['booked_by'] ? $ticket['booked_by'] : 'Not booked'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="shadow p-5 mt-5 flex gap-10">
            <form method="post" class="w-64" action="ticket-detail.php">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Ticket Type</label>
                <input type="text" id="name" name="name" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" required>

                <label for="price" class="block mt-2 text-gray-700 text-sm font-bold mb-2">Ticket Price</label>
                <input type="number" id="price" name="price" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" required>
                <input type="hidden" id="ticket_id" name="ticket_id" class="border rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400" value="<?= $id ?>">


                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600 mt-4">Add Types</button>
            </form>
            <div class="flex-1">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prices as $ticket) : ?>
                            <tr class="bg-gray-100">
                                <td class="border px-4 py-2"><?php echo $ticket['name']; ?></td>
                                <td class="border px-4 py-2"><?php echo $ticket['price']; ?></td>
                                <td class="border px-4 py-2">
                                    <a href="delete-ticket-detil.php?id=<?=$ticket['id']?>&main_id=<?=$id?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>

</html>