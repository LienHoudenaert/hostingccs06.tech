<?php
    // Include config file
    include "header.php";
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laravel Setup:</h1>
        </div>

        <p>Je website is zo ingesteld dat PHP applicaties in Laravel zonder veel moeite zal werken.<br>
        Er zijn nog wel enkele stapjes die jij als gebruiker zal moeten volgen om jouw applicatie op onze server te laten draaien. Deze stappen zijn:</p>
        <ol>
            <li>
                Ga via je FTP software naar je mapje op de server. Je kan deze <a href="ftps://172.26.6.100"><b>link</b></a> gebruiken om rechtstreeks naar de server te gaan.<br>
                Log hier in met je gebruikersnaam en je wachtwoord voor deze site.

                <br></br>
                Je gebruikersnaam kan je terugvinden als je rechts bovenaan op je emailadres klik en dan voor "profiel" kiest.<br>
                Het wachtwoord is je wachtwoord dat je gebruikt om in te loggen op deze website.
            </li>
            <br>
            <li>
                Eenmaal ingelogd kan je jouw bestanden in deze map plaatsen.
            </li>
            <br>
            <li>
                Als je bestanden in de map staan kan je op de "Composer Install" knop klikken. <br>Deze zal ervoor zorgen dat alle nodig bestanden worden aangemaakt om je Laravel app werkende te krijgen. 
                <br></br>
                <form method="post" action="">
                    <input class="btn btn-primary btn-sm" type="submit" name="composer" id="composer" value="Composer Install"/>
                </form>
            </li>
                
                <?php 
  
                if($_POST['composer']){

                    if(chdir("/var/www/html/$usernamesession") && shell_exec("sudo composer install") && shell_exec("sudo php artisan key:generate")) { ?>

                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Gelukt!</strong> Composer install is succesvol uitgevoerd.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div> <?php 
                    
                    } else { ?>
                            
                        <div style="position: absolute; top: 80px; right: 8px;">
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Mislukt!</strong> Composer install is niet succesvol uitgevoerd.
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        </div>
                
                   <?php } } elseif(isset($_POST['migrate'])) {
                    if (chdir("/var/www/html/$usernamesession") && shell_exec("php artisan key:generate") && shell_exec("php artisan migrate:fresh")) {
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
                }?>
                
            <br>
            <li>
                Standaard komt Laravel met een .env.example file, dit bestand bevat alle typische configuratiewaarden. Vanuit deze file kan je vertrekken om je .env aan te maken.<br>
                Zo kan je bijvoorbeeld de bestandsnaam ".env.example" vervangen door ".env".
                Pas de .env file aan zodat de waarden voor de database overeenkomen met de database die voor jouw is aangemaakt. <br>
                Je DB_DATABASE is je gebruikersnaam, je DB_USERNAME is opnieuw je gebruikersnaam, je DB_password is je wachtwoord voor deze site en DB_HOST is localhost. <br>
                Hieronder kan je een voorbeeld terugvinden van hoe het database gedeelte van je .env file er ongeveer moet uitzien.<br></br>

                <img src="/img/env.png" alt=".env file"/>
                
                <br></br>Stel dat je o.a. de .env niet kan zien, dan staan verborgen bestanden waarschijnlijk niet op zichtbaar in je FTP client.<br>
                Hoe je deze bestanden wel zichtbaar kan maken vind je <a href="ftp-info.php"><b>hier</b></a> terug.<br></br>
                
                Je kan deze <a href="http://172.26.6.100/phpmyadmin/" target="_blank"><b>link</b></a> gebruiken om naar je database in phpMyAdmin gaan.
            </li>
            <br>
            <li>
                Voer de database migratie uit. Druk op onderstaande "Migrate" knop om je database migratie te starten.<br>
                <strong>Let op!</strong> De migratie zal niet lukken als je je .env file nog niet hebt aangepast zodat deze overeenkomt met je databasenaam, databasegebruiker en wachtwoord.<br></br>               

                Je kan je .env file wijzigen met behulp van FTP.<br>
                Als je .env file in orde is kan je op de "Migrate" knop drukken.<br></br>
        
        <form action="" method="post">
                <button class="btn btn-primary btn-sm" type="submit" name="migrate" id="migrate" value="migrate">Migrate</button>
        </form>

            </li>
            <br>
            <li>Je kan je website terugvinden via volgende link: <a href="http://<?php echo $username['username'];?>.hostingccs06.tech" target="_blank"><?php echo $username['username'];?>.hostingccs06.tech</a>.</li>
        </ol>

        <br><p>Indien je problemen ondervind kan altijd een  ticket aan maken op de <a href="./support.php">support pagina</a>. Wij proberen je dan zo snel mogelijk verder te helpen.</p><br>

    </div>
    <!-- /.container-fluid -->

<?php
    // Include config file
    include "footer.php";
?>