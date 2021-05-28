<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$path = $_POST["docroot"];

$username = mysqli_query($link,"SELECT username FROM users WHERE id = $id");
$username = mysqli_fetch_array($username);

$uname = $username['username'];
$file = "$uname.conf";

$content = file($file);

foreach ($content as $line_num => $line) {
    if (false === (strpos($line, 'DocumentRoot'))) continue;

    $content[$line_num] = "DocumentRoot $path\n";
}

file_put_contents($file, $content);

shell_exec("systemctl restart apache2");
header("location: apache.php");
exit;

?>