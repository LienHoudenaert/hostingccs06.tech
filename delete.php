<?php

    // Initialize the session
    session_start();

    // Check if the user is logged in, otherwise redirect to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    // Include config file
    require_once "config.php";

    $iduser = (int)$_GET['id'];
    $username = mysqli_query($link,"SELECT username FROM users WHERE id = $iduser");
    $username = mysqli_fetch_array($username);
    $uname = $username['username'];

    $sql = "DELETE FROM users WHERE id = $iduser;";
    $sql1 = "DROP USER '$uname'@'localhost';";
    $sql2 = "DROP DATABASE $uname;";


    if (mysqli_query($link, $sql) && mysqli_query($link, $sql1) && mysqli_query($link, $sql2)) {

        shell_exec("sudo rm -r /var/www/html/$uname");
        shell_exec("sudo rm /etc/apache2/sites-available/$uname.conf");
        shell_exec("sudo a2dissite $uname");

        header("location: admin.php");
        $delete = '1';
        $_SESSION['delete'] = $delete;

    } else {
        header("location: admin.php");
        $delete = '0';
        $_SESSION['delete'] = $delete;
    }
?>

