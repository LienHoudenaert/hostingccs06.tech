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
             
            <h5><strong>Opmerking!</strong><br>
            Het gebruik van FTPS is vereist! Standaard FTP & SFTP zijn uitgeschakeld voor uw veiligheid.</h5><br>

            <h5>IP-adres & poort:</h5>
            <p>172.26.6.100  990 </p>
            <h5>Gebruikersnaam:</h5>
            <p><?php echo $username['username']; ?></p>
            <h5>Wachtwoord:</h5>
            <p>Je FTPS wachtwoord is je wachtwoord dat je gebruikt op deze website.</p>
            <br>

            <h5>Hidden files zichtbaar maken:</h5>
            <p>Indien je o.a. je .env.example niet kan zien, komt dit waarschijnlijk omdat jouw FTP client deze niet weergeeft.<br>
            In WINSCP kan je deze zichtbaar maken door Ctrl-Alt-H te doen. In Filezilla kan je dit doen door bovenaan op "Server" te klikken en daarna op "Tonen van verborgen bestanden forceren".<br>
            
            <br>
            <img src="/img/filezilla.png" alt="screenshot filezilla" heigth="30%"/>
            <br></br>

            Als je FTP client hierboven niet vernoemt is dan geven we een goede tip; Google is your friend &#128521;.</p>

            <p>Soms is kan het ook zijn dat je even moet wachten tot je verborgen bestanden tevoorschijn komen.</p>



    </div>
    <!-- /.container-fluid -->

<?php

    // Include config file
    include "footer.php";

?>