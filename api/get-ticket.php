<?php

include('config.php');


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM tickets";
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
