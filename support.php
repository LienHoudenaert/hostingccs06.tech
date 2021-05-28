<?php
    // Include config file
    include "header.php";

    // Define variables and initialize with empty values
    $namesupport = $usernamesupport = $emailsupport = $subjectsupport = $prioritysupport = $messagesupport = "";
    $name_err = $username_err = $email_err = $subject_err = $priority_err = $message_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
 
        // Validate firstname
        if(empty(trim($_POST["namesupport"]))){
            $name_err = "Geef je naam in.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tickets WHERE name = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_name);
                
                // Set parameters
                $param_name = trim($_POST["namesupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $namesupport = trim($_POST["namesupport"]);
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate username
        if(empty(trim($_POST["usernamesupport"]))){
            $username_err = "Geef je naam in.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tickets WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["usernamesupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $usernamesupport = trim($_POST["usernamesupport"]);
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    
        // Validate email
        if(empty(trim($_POST["emailsupport"]))){
            $email_err = "Vul je email adres in.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM users WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = trim($_POST["emailsupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $emailsupport = trim($_POST["emailsupport"]);
                    
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate subject
        if(empty(trim($_POST["subjectsupport"]))){
            $subject_err = "Geef een onderwerp in.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tickets WHERE subject = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_subject);
                
                // Set parameters
                $param_subject = trim($_POST["subjectsupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $subjectsupport = trim($_POST["subjectsupport"]);
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate subject
        if(empty(trim($_POST["prioritysupport"]))){
            $priority_err = "Kies een optie.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tickets WHERE priority = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_priority);
                
                // Set parameters
                $param_priority = trim($_POST["prioritysupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $prioritysupport = trim($_POST["prioritysupport"]);
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Validate subject
        if(empty(trim($_POST["messagesupport"]))){
            $message_err = "Typ een boodschap in.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM tickets WHERE message = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_message);
                
                // Set parameters
                $param_message = trim($_POST["messagesupport"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    $messagesupport = trim($_POST["messagesupport"]);
                } else{
                    echo "Oepsie! Daar ging iets fout. Probeer het later nog eens.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        
        
    
        // Check input errors before inserting in database
        if(empty($name_err) && empty($username_err) && empty($email_err) && empty($subject_err) && empty($priority_err) && empty($message_err)){
    
            // Prepare an insert statement
            $sql = "INSERT INTO tickets (name, email, username, subject, priority, message) VALUES (?,?,?,?,?,?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_email, $param_username, $param_subject, $param_priority, $param_message);
                
                // Set parameters
                $param_name = $namesupport;
                $param_email = $emailsupport;
                $param_username = $usernamesupport;
                $param_subject = $subjectsupport;
                $param_priority = $prioritysupport;
                $param_message = $messagesupport;
                
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
    
                    header("location: support.php");
                    $support = '1';
                    $_SESSION['support'] = $support;

                } else {
                    header("location: support.php");
                    $support = '0';
                    $_SESSION['support'] = $support;
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Close connection
        
        mysqli_close($link);
    }

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Support:</h1>
        </div>

            <p>Indien u problemen ondervindt of opmerkingen/vragen heeft voor ons, dan kan u ons bereiken via onderstaand formulier.</p>

            <div style="width:600px;">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                
                    <div class="form-group">
                        <!-- <label for="name">Naam</label> -->
                        <input type="hidden" name="namesupport" value="<?php echo $namesession?>" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> form-control-user" 
                        placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <!-- <label for="email">Emailadres</label> -->
                        <input type="hidden" name="emailsupport" value="<?php echo $emailsession?>" class="form-control form-control-user" placeholder="Emailadres">
                    </div>
                    <div class="form-group">
                        <!-- <label for="subject">Gebruikersaam</label> -->
                        <input type="hidden" name="usernamesupport" value="<?php echo $usernamesession?>" class="form-control form-control-user" >
                    </div>
                    <div class="form-group">
                        <!-- <label for="subject">Onderwerp</label> -->
                        <input type="text" name="subjectsupport" value="" class="form-control <?php echo (!empty($subject_err)) ? 'is-invalid' : ''; ?> form-control-user" 
                        placeholder="Onderwerp">
                    </div>
                    <div class="form-group">
                        <!-- <label for="option">Kies een optie:</label> -->
                        <select id="priority" name="prioritysupport" class="form-control <?php echo (!empty($priority_err)) ? 'is-invalid' : ''; ?> form-control-user">
                            <option value="" disabled selected>Kies een optie ...</option>
                            <option value="1">Probleem</option>
                            <option value="2">Vraag/opmerking</option>
                            <option value="3">Bug</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <!-- <label for="message">Typ hier je boodschap</label> -->
                        <textarea name="messagesupport" rows="5" cols="40" maxlength="500" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?> form-control-user" placeholder="Typ hier je boodschap..."></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Verzenden</button>
                    </div>
                
                </form>

                    <?php $support = $_SESSION['support'];
                                
                        if($support == '1'){ ?>

                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Gelukt!</strong> Het ticket is verzonden.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>

                        <?php $_SESSION['support'] = '-1'; } elseif($support == '0') { ?>

                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Mislukt!</strong> Het ticket is niet verzonden.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>

                        <?php $_SESSION['support'] = '-1'; } ?>
                
                
            
            </div>


    </div>
    <!-- /.container-fluid -->

<?php
    // Include config file
    include "footer.php";
?>