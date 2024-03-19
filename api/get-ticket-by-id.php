<?php

include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ticket_id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT tickets.*, prices.name as priceName, prices.price as prices, prices.id as priceId FROM tickets INNER JOIN prices ON tickets.id = prices.ticket_id WHERE tickets.id = ".$ticket_id;

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
