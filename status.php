<?php
    // Include config file
    include "header.php";
?>
   
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Status</h1>
            <div class="float-right"><p><i class="fas fa-square fa-xs" style="color:#1cc88a"></i> &nbsp; Beschikbaar &nbsp; <i class="fas fa-square fa-xs" style="color:#e74a3b"></i> &nbsp; Niet beschikbaar</p></div>
        </div>
        <!-- <p>Wanneer het vakje groen kleurt geeft dit aan dat de service beschikbaar is maar als het vakje rood kleurt is de service niet beschikbaar. Mocht u nog met vragen zitten na het lezen van de statuspagina, twijfel niet om contact op te nemen met onze support.<a href="./support.php"></br> Hosting Support</a></p> -->
        <p>Hier heb vind u een overzicht van alle services die we op onze server aanbieden. De status van de services wordt aangegeven.<br> Indien er services niet beschikbaar zijn kan je ons altijd contacteren via de <a href="./support.php">support</a> pagina.</p>
        <br>
        <table> 

        <tr>
            
            <?php if(empty(shell_exec("pgrep vsftpd")) ) { ?>
                <i class="fas fa-square fa-xs" style="color:#e74a3b"></i>
            <?php } elseif(!empty(shell_exec("pgrep vsftpd")) ) { ?>
                 <i class="fas fa-square fa-xs" style="color:#1cc88a"></i>
            <?php } ?>
            
            &nbsp; FTPS
        
        </tr><br></br>
        
        <tr>
            
            <?php if(empty(shell_exec("pgrep apache2")) ) { ?>
                <i class="fas fa-square fa-xs" style="color:#e74a3b"></i>
            <?php } elseif(!empty(shell_exec("pgrep apache2")) ) { ?>
                 <i class="fas fa-square fa-xs" style="color:#1cc88a"></i>
            <?php } ?>
            
            &nbsp; Webserver
        
        </tr><br></br>

        <tr>
            
            <?php if(empty(shell_exec("pgrep mysql")) ) { ?>
                <i class="fas fa-square fa-xs" style="color:#e74a3b"></i>
            <?php } elseif(!empty(shell_exec("pgrep apache2")) ) { ?>
                 <i class="fas fa-square fa-xs" style="color:#1cc88a"></i>
            <?php } ?>
            
            &nbsp; MySQL
        
        </tr>

        </table>
    </div>

	
<?php
    // Include config file
    include "footer.php";
?>