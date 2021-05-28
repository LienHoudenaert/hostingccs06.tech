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
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
  
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Geef een nieuw wachtwoord op.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Je wachtwoord moet minstens 6 karakters hebben.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig je wachtwoord.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Wachtwoord komt niet overeen.";
        }
    }

    // Validate new password
    if(!empty(trim($_POST["pagenamepassword"]))){
        $pagenamepassword = trim($_POST["pagenamepassword"]);
    }

    $_SESSION['new_password_err'] = $new_password_err;
    $_SESSION['confirm_password_err'] = $confirm_password_err;
    
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = crypt($new_password);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                $id = htmlspecialchars($_SESSION["id"]);
                $username = mysqli_query($link,"SELECT username FROM users WHERE id = $id");
                $username = mysqli_fetch_array($username);
                $uname = $username['username'];

                $sql1 = "ALTER USER '$uname'@'localhost' IDENTIFIED BY '$new_password';";

                if (mysqli_query($link, $sql1)) { 

                    // Password updated successfully. Destroy the session, and redirect to login page
                    session_destroy();
                    header("location: login.php");
                    $_SESSION['password_error'] = '1';
                    exit();
                
                } else {
                    header("location: $pagenamepassword");
                    $_SESSION['password_error'] = '0';
                }
            
            } else {
                header("location: $pagenamepassword");
                $_SESSION['password_error'] = '0';
            }
        
            

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    header("location: $pagenamepassword");
    $_SESSION['password_error'] = '0';
    
    
    // Close connection
    mysqli_close($link);
}
?>




 