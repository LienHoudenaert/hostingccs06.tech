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

            <h5>IP-adres:</h5>

            <p><?php echo $_SERVER['SERVER_ADDR']; ?></p>

            <h5>Gebruikersnaam:</h5>

            <p><?php echo $username['username']; ?></p>

    </div>
    <!-- /.container-fluid -->

<?php

    // Include config file
    include "footer.php";

?>