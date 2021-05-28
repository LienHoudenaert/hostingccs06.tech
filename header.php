<?php

// Initialize the session
session_start();
 
// // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

$idsession = htmlspecialchars($_SESSION["id"]);
$id = mysqli_query($link,"SELECT id FROM users WHERE id = $idsession");
$id = mysqli_fetch_array($id);

$firstname = mysqli_query($link,"SELECT firstname FROM users WHERE id = $idsession");
$firstname = mysqli_fetch_array($firstname);
$firstnamesession = $firstname['firstname'];

$lastname = mysqli_query($link,"SELECT lastname FROM users WHERE id = $idsession");
$lastname = mysqli_fetch_array($lastname);
$lastnamesession = $lastname['lastname'];

$email = mysqli_query($link,"SELECT email FROM users WHERE id = $idsession");
$email = mysqli_fetch_array($email);
$emailsession = $email['email'];

$username = mysqli_query($link,"SELECT username FROM users WHERE id = $idsession");
$username = mysqli_fetch_array($username);
$usernamesession = $username['username'];

$password = mysqli_query($link,"SELECT password FROM users WHERE id = $idsession");
$password = mysqli_fetch_array($password);
$passwordsession = $password['password'];

$admin = mysqli_query($link,"SELECT admin FROM users WHERE id = $idsession");
$admin = mysqli_fetch_array($admin);
$adminsession = $admin['admin'];

$active = mysqli_query($link,"SELECT active FROM users WHERE id = $idsession");
$active = mysqli_fetch_array($active);
$activesession = $active['active'];

$namesession = $firstname['firstname']." ".$lastname['lastname'];

?>

<?php $pagename = basename($_SERVER['PHP_SELF']); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HostingCCS06</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src='http://code.jquery.com/jquery-1.7.1.min.js'></script>
    <script> 
    
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 2000); 

</script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" style="min-height: 100vh;">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" style="z-index: 2;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-server"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hosting Platform</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($pagename == 'index.php') { echo " active"; } ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading"> -->
                <!-- Interface -->
            <!-- </div> -->

            <!-- Nav Item - Admin and Tickets - only visible/accessible for admins-->
            <?php if($adminsession == '1') { ?>
             
             <li class="nav-item <?php if($pagename == 'admin.php') { echo "active"; } ?>">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-user-cog"></i>
                    <span>Admin</span>
                </a>
            </li>

            <li class="nav-item <?php if($pagename == 'tickets.php') { echo "active"; } ?>">
                <a class="nav-link" href="tickets.php">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Tickets</span>
                </a>
            </li>


            <?php } ?>

            <!-- Nav Item - Laravel -->
            <li class="nav-item <?php if($pagename == 'laravel.php') { echo "active"; } ?>">
                <a class="nav-link" href="laravel.php">
                    <i class="fab fa-laravel"></i>
                    <span>Laravel</span>
                </a>
            </li>

            <!-- Nav Item - FTPS -->
            <li class="nav-item <?php if($pagename == 'ftp-info.php') { echo "active"; } ?>">
                <a class="nav-link" href="ftp-info.php">
                    <i class="fas fa-file-upload"></i>
                    <span>FTPS</span>
                </a>
            </li>

            <!-- Nav Item - Database -->
            <li class="nav-item <?php if($pagename == 'db-info.php') { echo "active"; } ?>">
                <a class="nav-link" href="db-info.php">
                    <i class="fas fa-database"></i>
                    <span>Database</span>
                </a>
            </li>

            
            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item <php if($pagename == 'doc.php') { echo "active"; } ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-file"></i>
                    <span>Documentatie</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bestanden:</h6>
                        <a class="collapse-item" href="doc.php">Document 1</a>
                        <a class="collapse-item" href="doc.php">Document 2</a>
                        <a class="collapse-item" href="doc.php">Document 3</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Documenten:</h6>
                        <a class="collapse-item" href="doc.php">Document 4</a>
                        <a class="collapse-item" href="doc.php">Document 5</a>
                    </div>
                </div>
            </li> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" style="padding-top: 100px; padding-left: 224px; padding-bottom: 0px;" class="d-flex flex-column">
        
        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow fixed-top" style="z-index:1;">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                   
                    <li class="nav-item <?php if($pagename == 'status.php') { echo "active"; } ?>">
                        <a class="nav-link" href="status.php">
                            <span><i class="fas fa-info-circle fa-1x"></i></span>
                        </a>
                    </li>

                    <li class="nav-item <?php if($pagename == 'support.php') { echo "active"; } ?>">
                        <a class="nav-link" href="support.php">
                            <span><i class="fas fa-question-circle fa-1x"></i></span>
                        </a>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $emailsession;?></span>
                            <img class="img-profile rounded-circle"
                                src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profiel
                            </a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsModal">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Instellingen
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Uitloggen
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->


            