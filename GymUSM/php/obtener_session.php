<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $response = [
        'loggedin' => true,
        'username' => $_SESSION['username']
    ];
} else {
    $response = [
        'loggedin' => false
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
