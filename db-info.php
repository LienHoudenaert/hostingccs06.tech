<?php

    // Include config file
    include "header.php";

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Database Informatie:</h1>
        </div>
                  
            <div style="margin-bottom: 7px;"><h6 style="font-size: 1.15em !important; display: inline;">Gebruikersnaam:</h6> <p style="display: inline"><?php echo $username['username']; ?></p></div>
            <div style="margin-bottom: 7px;"><h6 style="font-size: 1.15em !important; display: inline;">Wachtwoord:</h6> <p style="display: inline">Je FTPS wachtwoord is je wachtwoord dat je gebruikt op deze website.</p></div>
            <div style="margin-bottom: 7px;"><h6 style="font-size: 1.15em !important; display: inline;">Databasenaam:</h6> <p style="display: inline"><?php echo $username['username']; ?></p></div>
            <br>

            <p>Om te connecteren met de database, kan je gebruik maken van phpMyAdmin.<br>
            Eenmaal in phpMyAdmin kan je inloggen met de gegevens die hierboven terug te vinden zijn.<br></br>
            Als je ingelogd bent op je database dan kan je deze volledig zelf beheren. Het is niet mogelijk om je database te verwijderen of om een nieuwe database te maken.<br>
            Wanneer je op onderstaande knop klik, wordt je automatisch naar het phpMyAdmin portaal gestuurd.
            </p>

            <a href="http://172.26.6.100/phpmyadmin/" target="_blank">
                <button class="btn btn-primary btn-sm">phpMyAdmin</button>
            </a>
            <br></br>

           <p>Indien je problemen ondervind kan altijd een  ticket aan maken op de <a href="./support.php">support pagina</a>. Wij proberen je dan zo snel mogelijk verder te helpen.</p>

    </div>
    <!-- /.container-fluid -->

<?php

    // Include config file
    include "footer.php";

?>