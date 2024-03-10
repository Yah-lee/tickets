<?php
include('config.php');

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    $json_response = json_encode($users);
    header('Content-Type: application/json');
    echo $json_response;
} 
mysqli_close($conn);
?>
