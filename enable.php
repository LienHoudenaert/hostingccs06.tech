<?php
    // Include config file
    require_once "config.php";

    $iduser = (int)$_GET['id'];
    $username = mysqli_query($link,"SELECT username FROM users WHERE id = $iduser");
    $username = mysqli_fetch_array($username);
    $uname = $username['username'];

    $sql = "UPDATE users SET active = '1' WHERE id = $iduser;";


    if (mysqli_query($link, $sql)) {

        shell_exec("sudo a2ensite $uname");
        header("location: admin.php");

    } else {
        echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
    }
?>