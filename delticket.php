<?php 

    // Initialize the session
    session_start();

    // Include config file
    require_once "config.php";

    $idticket = (int)$_GET['id'];

    $sql = "DELETE FROM tickets WHERE id = $idticket;";

    if (mysqli_query($link, $sql)) {

        header("location: tickets.php");
        $tickets = '1';
        $_SESSION['tickets'] = $tickets;

    } else {
        header("location: tickets.php");
        $tickets = '0';
        $_SESSION['tickets'] = $tickets;
    }


?>
