<?php

    // Include config file
    include "header.php";

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">FTPS Informatie:</h1>
        </div>
             
            <h6 style="font-size: 1.1em !important;"><strong>Opmerking!</strong> Het gebruik van FTPS is vereist! Standaard FTP & SFTP zijn uitgeschakeld voor uw veiligheid.</h6><br>

            <div style="margin-bottom: 7px;"> <h6 style="font-size: 1.15em !important; display: inline;">IP-adres & poort:</h6> <p style="display: inline"><?php echo $_SERVER['SERVER_ADDR'];?>  990 </p> </div>
            <div style="margin-bottom: 7px;"><h6 style="font-size: 1.15em !important; display: inline;">Gebruikersnaam:</h6> <p style="display: inline"><?php echo $username['username']; ?></p></div>
            <div style="margin-bottom: 7px;"><h6 style="font-size: 1.15em !important; display: inline;">Wachtwoord:</h6> <p style="display: inline">Je FTPS wachtwoord is je wachtwoord dat je gebruikt op deze website.</p></div>
            
            <br>

            <h5><u>Verborgen bestanden</u> zichtbaar maken:</h5>
            <p>Indien je o.a. je .env.example niet kan zien, komt dit waarschijnlijk omdat jouw FTP client deze niet weergeeft.<br>
            In WINSCP kan je deze zichtbaar maken door Ctrl-Alt-H te doen. In Filezilla kan je dit doen door bovenaan op "Server" te klikken en daarna op "Tonen van verborgen bestanden forceren".<br>
            
            <br>
            <img src="/img/filezilla.png" alt="screenshot filezilla" width="520px"/>
            <br></br>

            Als je FTP client hierboven niet vernoemt is dan geven we een goede tip; Google is your friend &#128521;.</p>

            <p>Soms is kan het ook zijn dat je even moet wachten tot je verborgen bestanden tevoorschijn komen.</p>

            <br><p>Indien je problemen ondervind kan altijd een  ticket aan maken op de <a href="./support.php">support pagina</a>. Wij proberen je dan zo snel mogelijk verder te helpen.</p><br>



    </div>
    <!-- /.container-fluid -->

<?php

    // Include config file
    include "footer.php";

?>