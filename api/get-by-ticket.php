<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $ticket_id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM tickets WHERE id = $ticket_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $ticket = mysqli_fetch_assoc($result);

            $json_response = json_encode($ticket);

            header('Content-Type: application/json');

            echo $json_response;
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Ticket not found'
            );

            $json_response = json_encode($response);

            header('Content-Type: application/json');

            echo $json_response;
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ticket ID is required'
        );

        $json_response = json_encode($response);

        header('Content-Type: application/json');

        echo $json_response;
    }
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request method'
    );

    $json_response = json_encode($response);

    header('Content-Type: application/json');

    echo $json_response;
}

mysqli_close($conn);
?>
