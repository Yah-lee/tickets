<?php
include('header.php');
include('config.php');

$sql = "SELECT * FROM tickets ";
$result = mysqli_query($conn, $sql);

// Check if there are any tickets
if (mysqli_num_rows($result) > 0) {
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $tickets = [];
}

?>
<div>

    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-bold mb-4">List of Tickets</h2>
        <a href="add-ticket.php">Add Ticket</a>

        <!-- Display tickets in a table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Movie Title</th>
                        <th class="px-4 py-2">Screening Time</th>
                        <th class="px-4 py-2">Seat Number</th>
                        <th class="px-4 py-2">Booked By</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through tickets data and display in rows -->
                    <?php foreach ($tickets as $ticket) : ?>
                        <tr class="bg-gray-100">
                            <td class="border px-4 py-2"><?php echo $ticket['id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['movie_title']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['screening_time']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['seat_number']; ?></td>
                            <td class="border px-4 py-2"><?php echo $ticket['booked_by'] ? $ticket['booked_by'] : 'Not booked'; ?></td>
                            <td class="border px-4 py-2">
                                <!-- Delete button -->
                                <form action="delete-ticket.php" method="post">
                                    <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600">Delete</button>
                                </form>
                                <a href="ticket-detail.php?id=<?=$ticket['id']?>">Add prices</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>

</html>