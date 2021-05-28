<?php
    // Include config file
    include "header.php";

    $uname = $username['username'];
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laravel Database Migratie:</h1>
        </div>

        <p>Druk op onderstaande "Migrate" knop om je database migratie te starten.<br>
        <strong>Let op!</strong> De migratie zal niet lukken al je je .env file nog niet hebt aangepast zodat deze overeenkomt met je databasenaam, databasegebruiker en wachtwoord.<br></br>
        Hieronder kan je een voorbeeld terugvinden van hoe het database gedeelte van je .env file er ongeveer moet uitzien.</p>

        <img src="/img/env.png" alt=".env file"/>

        <br></br><p>Je kan je .env file wijzigen met behulp van FTP.<br>
        Als je .env file in orde is kan je op de "Migrate" knop drukken</p>


        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (chdir("/var/www/html/$usernamesession") && shell_exec("php artisan migrate:fresh")) {
                    ?>
                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Gelukt!</strong> De database migratie is uitgevoerd.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>    
        
                    <?php   
                } else {

                    ?>
                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Mislukt!</strong> De database migratie niet is uitgevoerd.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>    
        
                    <?php   

                }
            }
        ?>
        <form action="" method="post">
            <p>
                <button class="btn btn-danger btn-sm" type="submit" name="migrate">Migrate</button>
            </p>
        </form>

    </div>
    <!-- /.container-fluid -->

<?php
    // Include config file
    include "footer.php";
?>