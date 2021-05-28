<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Vul je emil adres in.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Geef je wachtwoord in.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){

        // Prepare a select statement
        $sql = "SELECT id, email, admin, active, password FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $admin, $active, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["active"] = $active;


                            if($_SESSION["active"] == '0') {
                                $active_err = "Dit account is disabled! 
                                Neem contact op met de beheerder via hostingccs06@gmail.com voor meer informatie.";
                                session_destroy();
                                // header("location: login.php");
                                
                            } else {
                                
                                if($_SESSION["admin"] == '1') {
                                    header("location: admin.php");
                                } else { 
                                    // Redirect user to welcome page
                                    header("location: index.php");
                                }
                                
                            }
 
                            
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Email of wachtwoord ongeldig.";
                        }
                    }
                } else{
                    // Email doesn't exist, display a generic error message
                    $login_err = "Email of wachtwoord ongeldig.";
                }
            } else{
                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
    
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Lien Houdenaert">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welkom Terug!</h1>
                                    </div>
                                    <?php 
                                        if(!empty($login_err)){
                                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                        }       
                                        if(!empty($active_err)){
                                            echo '<div class="alert alert-danger">' . $active_err . '</div>';
                                        }  
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Geef je Email Adres...">
                                                <span class="invalid-feedback"><?php echo $email_err; ?></span>

                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                                id="exampleInputPassword" placeholder="Wachtwoord">
                                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Wachtwoord vergeten?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Account aanmaken!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>