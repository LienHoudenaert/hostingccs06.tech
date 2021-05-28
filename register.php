<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $password = $confirm_password = $new_username = "";
$firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Geef je voornaam in.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE firstname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_firstname);
            
            // Set parameters
            $param_firstname = trim($_POST["firstname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $firstname = trim($_POST["firstname"]);
            } else{
                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Geef je achternaam in.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE lastname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_lastname);
            
            // Set parameters
            $param_lastname = trim($_POST["lastname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $lastname = trim($_POST["lastname"]);

            } else{
                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Vul je email adres in.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $email = trim($_POST["email"]);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Dit email adres is al in gebruik.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Geef een wachtwoord in.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Je wachtwoord moet minstens 6 karakters hebben.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig je wachtwoord.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Wachtwoord komt niet overeen.";
        }
    }
    
    
    

    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){

        // Validate username
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
        
            $param_username = strtolower($firstname.$lastname);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $username = strtolower($firstname.$lastname);
                $i = 1;

                while(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
        
                    $param_username = strtolower($firstname.$lastname.$i);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        $username = strtolower($firstname.$lastname.$i);
                        $i++;
                    }
                } 

                $username = strtolower($username);

            } else{
                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, email, username, password, admin, active) VALUES (?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_firstname, $param_lastname, $param_email, $param_username, $param_password, $param_admin, $param_active);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_username = $username;
            $param_password = crypt($password);
            $param_admin = "0";
            $param_active = "1";
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                // Create database

                $sql1 = "CREATE DATABASE $username;";

                if (mysqli_query($link, $sql1)) {

                    $sql2 = "CREATE USER '$username'@'localhost' IDENTIFIED BY '$password';";

                    if (mysqli_query($link, $sql2)) {

                        $sql3 = "GRANT SELECT, INSERT, UPDATE, DELETE ON $username.* TO '$username'@'localhost';";
                        
                        if (mysqli_query($link, $sql3)) { 

                            $sql4 = "GRANT CREATE, ALTER, DROP, REFERENCES ON $username.* TO '$username'@'localhost';";

                            if (mysqli_query($link, $sql4)) {

                                $path = "/var/www/html/$username";
                                $log = '${APACHE_LOG_DIR}';
                                $ipa = $_SERVER['SERVER_ADDR'];


                                $filename = "/etc/apache2/sites-available/$username.conf";
                                //Open the file for reading
                                $file_handler = fopen($filename, 'w');
                                //Check the file handler is created or not
                                if($file_handler) {
                                    //Write the particular content in the file

                                    $data =

"<VirtualHost *:80>
    ServerName $username.hostingccs06.tech
    ServerAdmin webmaster@$username.hostingccs06.tech
    DocumentRoot /var/www/html/$username/public
    
    ErrorLog $log/error.log
    CustomLog $log/access.log combined
                                 
    <Directory /var/www/html/$username>
           AllowOverride All
    </Directory>
                                                                        
</VirtualHost>";

                                    fwrite($file_handler, $data);
                                    //Close the file
                                    fclose($file_handler);

                                    shell_exec("sudo mkdir /var/www/html/$username");

                                    chdir("/var/www/");
                                    shell_exec("./cf-dns.sh -d hostingccs06.tech -t A -n $username -c 172.26.6.100 -l 1 -x n");

                                    exec("sudo a2ensite $username.conf");

                                    // Redirect to login page
                                    header("location: login.php");
                                      
                                } else {
                                    
                                    ///Print the error message
                                    echo "Het bestand kan niet geopend worden.";
                                }
                                
                            } else {
                                echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                            }

                        } else {
                            echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                        }

                    } else {
                        echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                    } 

                } else {
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
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
    <meta name="author" content="">

    <title>Register</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Account Aanmaken!</h1>
                            </div>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?> form-control-user" value="<?php echo $firstname; ?>" 
                                            placeholder="Voornaam">
                                        <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastname" class="form-control form-control-user <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>"
                                            placeholder="Achternaam">
                                        <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"
                                        placeholder="Email adres">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"
                                            placeholder="Wachtwoord">
                                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_password" class="form-control form-control-user <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"
                                            placeholder="Bevestig wachtwoord">
                                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Registeer account">
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Wachtwoord vergeten?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Heb je al een account? Login!</a>
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