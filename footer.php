<?php 
    
    $pagenamepassword = basename($_SERVER['PHP_SELF']);
    $_SESSION['pagenamepassword'] = $pagenamepassword; 

    $password_error = "";

    $new_password_err = "";
    $confirm_password_err = "";

?>



</div>
<!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CCS06 Hosting 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->       

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Klaar om te site te verlaten?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik op "Logout" als je klaar bent om je sessie te beëindigen.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleer</button>
                    <a class="btn btn-primary" href="logout.php">Uitloggen</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Modal-->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profiel Informatie</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voornaam: <?php echo $firstnamesession; ?></br>
                    Achternaam: <?php echo $lastnamesession; ?></p>
                    <p>Email: <?php echo $emailsession;  ?></br>
                    Gebruikersnaam: <?php echo $usernamesession; ?></p>
                    <p>Rol: <?php if($adminsession == '1'){ echo "Admin";}elseif($adminsession == '0'){ echo "Gebruiker";} ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Sluiten</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal-->
    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instellingen</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Wachtwoord: <p></p>
                    <a class="btn btn-light btn-icon-split btn-sm" href="#" data-toggle="modal" data-target="#passwordModal">
                        <span class="icon text-gray-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Wijzig wachtwoord</span>
                    </a>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Sluiten</button>       
                </div>
            </div>
        </div>
    </div> 

    <!-- Password Modal-->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Wijzig wachtwoord</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>           
                    <div class="modal-body">Vul dit formulier in om je wachtwoord te wijzigen.
                        <form action="reset-password.php" method="post"> 
                            <div class="form-group">
                                <label>Nieuw wachtwoord</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Bevestig wachtwoord</label>
                                <input type="password" name="confirm_password" class="form-control">
                            </div>   
                            <div class="form-group">
                                <input type="hidden" name="pagenamepassword" class="form-control" value="<?php echo $pagenamepassword;?>">
                            </div>  
                            <div class="form-group">
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuleer</button>
                                    <input class="btn btn-primary" type="submit" value="Verzenden">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php 
        
        $password_error = $_SESSION['password_error'];

        $new_password_err = $_SESSION['new_password_err'];
        $confirm_password_err = $_SESSION['confirm_password_err'];
                             
        if($password_error == '0') { ?>

        <div style="position: absolute; top: 80px; right: 8px; height: 10px;">
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Mislukt!</strong> Wachtwoord niet gewijzigd. <br>
            <ul style="list-style-type:'-    ';">
            <?php if(!empty($new_password_err)) {?> <li><?php echo $new_password_err; ?></li> <?php } ?>
            <?php if(!empty($confirm_password_err)) { ?> <li><?php echo $confirm_password_err; ?></li> <?php } ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        </div>

        <?php $_SESSION['password_error'] = '-1'; } ?>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>

    $(document).ready(function(){  

    var checkField;

    //checking the length of the value of message and assigning to a variable(checkField) on load
    checkField = $("input#docroot").val().length;  

    var enableDisableButton = function(){         
        if(checkField > 0){
            $('#apply').removeAttr("disabled");
        } else {
            $('#apply').attr("disabled","disabled");
        }
    }        
        //calling enableDisableButton() function on load
        enableDisableButton();            

        $('input#docroot').keyup(function(){ 
        
            //checking the length of the value of message and assigning to the variable(checkField) on keyup
            checkField = $("input#docroot").val().length;
            
            //calling enableDisableButton() function on keyup
            enableDisableButton();
        
        });
    });

</script>

</body>

</html>