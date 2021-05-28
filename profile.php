<?php

// Initialize the session
  session_start();
  
  if($_SESSION["admin"] == '0') {
    header("location: index.php");
  }

  include 'header.php';
  require_once "config.php";

  $idprofile = (int)$_GET['id'];

  $firstnameprofile = mysqli_query($link,"SELECT firstname FROM users WHERE id = $idprofile");
  $firstnameprofile = mysqli_fetch_array($firstnameprofile);
  $isfirstnameprofile = $firstnameprofile["firstname"];

  $lastnameprofile = mysqli_query($link,"SELECT lastname FROM users WHERE id = $idprofile");
  $lastnameprofile = mysqli_fetch_array($lastnameprofile);
  $islastnameprofile = $lastnameprofile["lastname"];

  $emailprofile = mysqli_query($link,"SELECT email FROM users WHERE id = $idprofile");
  $emailprofile = mysqli_fetch_array($emailprofile);
  $isemailprofile = $emailprofile["email"];

  $usernameprofile = mysqli_query($link,"SELECT username FROM users WHERE id = $idprofile");
  $usernameprofile = mysqli_fetch_array($usernameprofile);
  $isusernameprofile = $usernameprofile["username"];

  $adminprofile = mysqli_query($link,"SELECT admin FROM users WHERE id = $idprofile");
  $adminprofile = mysqli_fetch_array($adminprofile);
  $isadminprofile = $adminprofile['admin'];

  $nameprofile = $islastnameprofile . " " . $isfirstnameprofile;

// Define variables and initialize with empty values
$firstnamepro = $lastnamepro = $emailpro = $adminpro = "";
$firstname_err = $lastname_err = $email_err = $admin_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstnamepro"]))){
        $firstname_err = "Geef je voornaam in.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE firstname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_firstname);
            
            // Set parameters
            $param_firstname = trim($_POST["firstnamepro"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $firstnamepro = trim($_POST["firstnamepro"]);
                $_SESSION['profile'] = '1';
            } else{ 
              $_SESSION['profile'] = '0';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate lastname
    if(empty(trim($_POST["lastnamepro"]))){
        $lastname_err = "Geef je achternaam in.";
        $_SESSION['profile'] = '0';
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE lastname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_lastname);
            
            // Set parameters
            $param_lastname = trim($_POST["lastnamepro"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $lastnamepro = trim($_POST["lastnamepro"]);
                $_SESSION['profile'] = '1';

            } else{
              $_SESSION['profile'] = '0';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email
    if(empty(trim($_POST["emailpro"]))){
        $email_err = "Vul je emailadres in.";
        $_SESSION['profile'] = '0';
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["emailpro"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $emailpro = trim($_POST["emailpro"]);
                if ($isemailprofile != $emailpro){
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      $email_err = "Dit emailadres is al in gebruik.";
                      $_SESSION['profile'] = '0';
                  } else{
                      $emailpro = trim($_POST["emailpro"]);
                      $_SESSION['profile'] = '1';
                  }
                } 
            } else {
              // header("location: profile.php?id=$idprofile");
              $_SESSION['profile'] = '0';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate admin
    if(empty(trim($_POST["adminpro"]))){
        $admin_err = "Selecteer een optie.";
        $_SESSION['profile'] = '0';
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE admin = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_admin);
            
            // Set parameters
            $param_admin = trim($_POST["adminpro"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $adminpro = trim($_POST["adminpro"]);

                if($adminpro == '1'){
                  $adminpro = '1';
                } else {
                  $adminpro = '0';
                }
            
                $_SESSION['profile'] = '1';

            } else{
                // header("location: profile.php?id=$idprofile");
                $_SESSION['profile'] = '0';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($admin_err)){

        // Prepare an insert statement
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, admin = ? WHERE id = ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_firstname, $param_lastname, $param_email, $param_admin, $param_id);
            
            // Set parameters
            $param_firstname = $firstnamepro;
            $param_lastname = $lastnamepro;
            $param_email = $emailpro;
            $param_admin = $adminpro;
            $param_id = $idprofile;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

              header("location: admin.php");
              $_SESSION['profile'] = '1';
                
            } else {
              header("location: admin.php");
              $_SESSION['profile'] = '0';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
      $_SESSION['profile'] = '0';
    }
    
    header("location: admin.php");
    

    // Close connection
    mysqli_close($link);
}

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <?php if(!empty($firstnamepro)){ $nameprofile = $lastnamepro . " " . $firstnamepro; } ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profiel van <?php echo $nameprofile; ?>: </h1>
            <br> 
        </div>

          <div style="width:600px;">

          <?php $thispage = htmlspecialchars($_SERVER["PHP_SELF"]); 


          $profile = htmlspecialchars($_SESSION['profile']);
                              
            if($profile == '1'){ ?>

            <div style="position: absolute; top: 80px; right: 8px;">
              <div class="alert alert-success alert-dismissible fade show">
                  <strong>Gelukt!</strong> Account is geüpdatet.
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            </div>

            <?php $_SESSION['profile'] = '-1'; } elseif($profile == '0') { ?>

            <div style="position: absolute; top: 80px; right: 8px;">
              <div class="alert alert-danger alert-dismissible fade show">
                  <strong>Mislukt!</strong> Account is niet geüpdatet .
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
              </div>
            </div>

          <?php $_SESSION['profile'] = '-1'; } 

          if(!empty($firstnamepro)){
          
          $isfirstnameprofile = $firstnamepro;
          $islastnameprofile = $lastnamepro;
          $isemailprofile = $emailpro;
          $isadminprofile = $adminpro;

          }
          
          ?>

          <form action="<?php echo "$thispage?id=$idprofile";?>" method="post">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="firstnamepro">Voornaam</label>
                  <input type="text" id="firstnamepro" name="firstnamepro" value="<?php echo $isfirstnameprofile; ?>" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?> form-control-user" placeholder="Voornaam">
                  <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                </div>
                <div class="col-sm-6">
                  <label for="lastnamepro">Achternaam</label>
                  <input type="text" id="lastnamepro" name="lastnamepro" value="<?php echo $islastnameprofile; ?>" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?> form-control-user" placeholder="Achternaam">
                  <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                </div>
              </div>
              <div class="form-group">
                <label for="usernamepro">Gebruikersnaam</label>
                <input type="text" id="usernamepro" name="usernamepro" readonly="readonly" value="<?php echo $isusernameprofile; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label for="emailpro">Emailadres</label>
                <input type="email" id="emailpro" name="emailpro" value="<?php echo $isemailprofile; ?>" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?> form-control-user" placeholder="Email">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
              </div>

              <?php if ($adminsession == '1') { ?>

              <div class="form-group
              <?php if ($adminsession == '1' && $idsession == $idprofile) {
                echo "d-none";
              } ?>
              ">
                <div class="form-group">
                  <label for="adminpro">Selecteer een rol (admin/user):</label>
                  <select class="form-control" name="adminpro" id="adminpro">

                  <option value="1" <?php if($isadminprofile == '1'){ echo "selected";} ?>>Admin</option>
                  <option value="2" <?php if($isadminprofile == '0'){ echo "selected";} ?>>User</option>

                  </select>
                </div>
              </div>

          <?php } ?>

              <?php if($adminsession == '1') {?>
              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <span> <a href="admin.php" class="btn btn-primary">Terug</a></span>
              </div>
              <?php } else { ?>
                  <div class="form-group">

                    <a class="btn btn-primary" href="admin.php">Ok</a>
                  </div>
                <?php } ?>
          </form>
        </div>
      </div>
      <!-- /.container-fluid -->
  
<?php
  
  include 'footer.php';

?>
