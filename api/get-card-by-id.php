<?php

include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ticket_id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT order_detail.*, tickets.movie_title, tickets.screening_time FROM `order_detail` INNER JOIN tickets on tickets.id = order_detail.ticket_id WHERE order_detail.id =  ".$ticket_id;

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $tickets = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $tickets[] = $row;
        }

        $json_response = json_encode($tickets);

        header('Content-Type: application/json');


        
        echo $json_response;
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'No tickets found'
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
