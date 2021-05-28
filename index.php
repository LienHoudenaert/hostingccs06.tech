<?php

    // Include config file
    include "header.php";

?>
   
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Welkom <b> <?php echo $namesession; ?></b></h1>
        </div>
        <div><p> Op ons platform kan je terecht om je website of webapplicatie te laten hosten.
        <br>Tijdens het registreren werden er enkele zaken voor jouw in orde gebracht, zodat jij als gebruiker een zo'n vlot mogelijke service ervaart.
        <br>De stapjes die je zelf nog moet doorlopen om je website of webapplicatie te laten draaien, worden op ze duidelijk mogelijk beschreven.
        <br></br>Links in de navigatie bar vind u de informatie die u nodig heeft voor FTP & Database beheer met phpMyAdmin.
        <br>Mocht meer informatie willen over hoe u onze services gebruikt, raadpleeg onze documentatie.</p>

        <br>
        <h5>Webapplicatie <u>zonder</u> Laravel</h5>
        <p>Als je applicatie geen Laravel gebruikt kan je onderstaande stappen volgen om je website te laten werken:<br></p>
        <ol>
            <li>Ga via je FTP software naar je mapje op de server. Je kan deze <a href="ftps://172.26.6.100">link</a> gebruiken om rechtstreeks naar de server te gaan.<br>
                Log hier in met je gebruikersnaam en je wachtwoord voor deze site.</li>
            <li>Eenmaal ingelogd maak je een mapje <strong>public</strong> aan, plaats je bestanden in deze "public" map.<br>
            Indien je geen mapje kan aanmaken, kan je best 5 minuten wachten. Als het daarna nog steeds niet lukt neem je best <a href="./support.php">contact</a> met ons op.</li>
            <li>Indien je webapp een database gebruikt, kan je deze in orde brengen via deze <a href="http://172.26.6.100/phpmyadmin/" target="_blank">link</a>.
            Je word nu naar de phpMyAdmin site geleid, log hier in met je gebruikersnaam en je wachtwoord.
            <br></br>
            Je gebruikersnaam kan je terugvinden als je rechts bovenaan op je emailadres klik en dan voor "profiel" kiest.<br>
            Het wachtwoord is je wachtwoord dat je gebruikt om in te loggen op deze website.
            </li><br>
            <li>Je kan je website terugvinden via volgende link: <a href="http://<?php echo $username['username'];?>.hostingccs06.tech" target="_blank"><?php echo $username['username'];?>.hostingccs06.tech</a>.</li>
        </ol>

        <p>Indien je website niet werkt, kan het zijn dat je 5 minuutjes moet wachten.
        <br>Werkt je website na 15 minuten nog niet, kan je je configuratie best even nakijken en/of <a href="./support.php">contact</a> met ons opnemen.</p>
        
        <br>
        <h5>Webapplicatie <u>met</u> Laravel</h5>
        <p>Indien je PHP applicatie gebruik maakt van Laravel kan je naar de <a href="laravel.php">"Laravel"</a> pagina gaan.<br> 
        Hier zal je alle informatie terugvinden die je nodig hebt om je laravel applicatie werkende te krijgen.</p>

        <br>
        <h5>Support</h5>
        <p>Mocht u nog hulp nodig hebben na het lezen van de documentatie, twijfel niet om contact op te nemen met onze support. <br>
        Rechts bovenaan ziet u een grijs vraagtekentje, hier kan je hulp vragen bij een probleem, bugs melden of je kan er terecht voor algemene vragen en opmerkingen. <br>
        Natuurlijk kan u ook naar onze support pagina gaan om een ticket aan te maken. <br>
        <a href="./support.php">Hosting Support - Contacteer ons.</a>
        </p>
        </div>
    </div>
<?php
    // Include config file
    include "footer.php";
?>

            