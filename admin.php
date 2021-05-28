<?php

    // Initialize the session
    session_start();

    if ($_SESSION["admin"] == '0') {
        header("location: index.php");
    }

    // Include config file
    include "header.php";  

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <?php 
            
      $query = mysqli_query($link, "SELECT * FROM users ORDER BY lastname ASC");
      $queryempty = mysqli_query($link, "SELECT * FROM users ORDER BY lastname ASC");
                  
      if(count($_POST)>0) {
        $search = $_POST['search'];
        $query = mysqli_query($link, "SELECT * FROM users WHERE firstname=\"$search\" OR lastname=\"$search\" OR username=\"$search\" ORDER BY lastname ASC");
        $queryempty = mysqli_query($link, "SELECT * FROM users WHERE firstname=\"$search\" OR lastname=\"$search\" OR username=\"$search\" ORDER BY lastname ASC");
      } 

      if(empty(mysqli_fetch_array($queryempty))) {?>

        <h4>Geen gebruiker gevonden!</h4>
        <p>Gezocht op <?php echo $search;?></p>
        <span> <a href="admin.php" class="btn btn-primary btn-sm">Terug</a></span>
        <?php

      } else {
          
    ?>              
                
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php if(count($_POST)>0) { ?> Resultaten voor <?php echo $search .":";  } else { ?> Lijst met gebruikers: <?php } ?></h1>
            <!-- Topbar Search -->

          <!-- Topbar Search -->
        
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="padding-left: 224px" action="admin.php" method="post">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control bg-light border-0 small" placeholder="Zoeken naar gebruiker..."
                    aria-label="Search" aria-describedby="basic-addon2" style="background-color: #ffffff !important; width: 300px;">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="save" id="save">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>  
            </div>
        </form>

        <script>

            $(document).ready(function(){  

            var checkField;

            //checking the length of the value of message and assigning to a variable(checkField) on load
            checkField = $("input#search").val().length;  

            var enableDisableButton = function(){         
            if(checkField > 0){
                $('#save').removeAttr("disabled");
            } 
            else {
                $('#save').attr("disabled","disabled");
            }
            }        

            //calling enableDisableButton() function on load
            enableDisableButton();            

            $('input#search').keyup(function(){ 
            //checking the length of the value of message and assigning to the variable(checkField) on keyup
            checkField = $("input#search").val().length;
            //calling enableDisableButton() function on keyup
            enableDisableButton();
            });
            });

        </script>

        </div>
        <span><a href="admin.php" class="btn btn-primary btn-sm">Terug</a></span>
            <br></br>
          
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th  class="text-center">Naam</th>
                      <th  class="text-center">Gebruikersnaam</th>
                      <th  class="text-center">Emailadres</th>
                      <th  class="text-center">Rol</th>
                      <th  class="text-center">Status</th>
                      <th  width='18%' class="text-center">Acties</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $c = 0;
                        while ($row = mysqli_fetch_array($query)) {
                            
                            $id[$c] = $row['id'];
                            $firstname[$c] = $row['firstname'];
                            $lastname[$c] = $row['lastname'];
                            $email[$c] = $row['email'];
                            $username[$c] = $row['username'];
                            $admin[$c] = $row['admin'];
                            $active[$c] = $row['active'];
                            
                            $c++;
                        }

                        if ($_GET["start"] > 0) {
                            $start = $_GET["start"];
                        } else {
                          $start = 0;
                        }
        
                        $showresults = 9;
                        $end = $start + $showresults;
                        $countresult = $c;
                        if ($end > $countresult){
                            $end = $countresult;
                        }
                        for ($i=$start; $i<$end; $i++){
                            ?>

                        <tr class="text-center">
                        
                        <td><?php echo $lastname[$i] . " " . $firstname[$i]; ?></td>
                        <td><?php echo $username[$i]; ?> </td>
                        <td><?php echo $email[$i]; ?></td>
                        
                        <td>  <?php if ($admin[$i]  == '1'){
                          echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                          // <i class='fas fa-crown fa-xs' style='margin-top: -1px;'></i> &nbsp; 
                        }elseif ($admin[$i] == '0') {
                            echo "<span class='badge badge-lg badge-dark text-white'>User</span>";
                        } ?></td>
  
                        <td><?php if ($active[$i] == '1') { ?>
                          <span class="badge badge-lg badge-info text-white">Active</span>
                        <?php }else{ ?>
                            <span class="badge badge-lg badge-danger text-white">Inactive</span>
                        <?php } ?></td>

                        <td>
                          <?php if ( $adminsession == '1') {?>
                            <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $id[$i];?>">Edit</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                    
                            <?php if ($idsession == $id[$i]) {
                                echo "disabled";
                            } ?>
                             
                             btn-sm " href="delete.php?id=<?php echo $id[$i];?>">Delete</a>

                             <?php $delete = $_SESSION['delete'];
                             
                             if($delete == '1'){ ?>

                              <div style="position: absolute; top: 80px; right: 8px;">
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Gelukt!</strong> De gebruiker is verwijderd.
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                              </div>

                             <?php $_SESSION['delete'] = '-1'; } elseif($delete == '0') { ?>

                              <div style="position: absolute; top: 80px; right: 8px;">
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Mislukt!</strong> De gebruiker is niet verwijderd.
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                              </div>

                             <?php $_SESSION['delete'] = '-1'; } ?>

                             <?php if ($active[$i] == '1') {  ?>
                               <a onclick="return confirm('Are you sure you want to disable this account?')" class="btn btn-warning
                       <?php if ($idsession == $id[$i]) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="disable.php?id=<?php echo $id[$i];?>">Disable</a>
                             <?php } elseif($active[$i] == '0'){?>
                               <a onclick="return confirm('Are you sure you want to to enable this account?')" class="btn btn-secondary
                       <?php if ($idsession == $id[$i]) {
                         echo "disabled";
                       } ?>
                                btn-sm " href="enable.php?id=<?php echo$id[$i];?>"> Enable </a>
                             <?php } ?>


                        <?php }elseif($idsession == $id[$i] && $adminsession == '0'){ ?>
                          <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $id[$i];?>">Edit</a>
                        <?php } ?>

                        </td>
                      </tr>
                      <?php   
                    }
                    ?>
                      </table>

                      <nav aria-label="Page navigation">
                        <ul class="pagination">
                        <?php
                            $pages = ($countresult / $showresults);
                            if ($start > 0){ ?>
                                <li class="page-item">
                                    <a class="page-link" href='admin.php?start=<?php echo ($start - $showresults); ?>'aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span>
                                    <span class="sr-only">Previous</span></a></li>
                            <?php
                            } else { ?>
                                <li class="page-item disabled ">
                                    <a class="page-link" href='#'aria-label="Previous" tabindex="-1">
                                    <span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span>
                                    <span class="sr-only">Previous</span></a></li><?php
                            }
                            for ($p=0; $p<$pages; $p++){
                            
                                echo "<li class=\"page-item\"><a class=\"page-link\" href=\"admin.php?start=".($p * $showresults)."\">".($p + 1)."</a><li>";
                                }
    
                            if ($end < $countresult){ ?>
                                <li class="page-item"><a class="page-link" href='admin.php?start=<?php echo ($start + $showresults); ?>'aria-label="Next">
                                    <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>
                                    <span class="sr-only">Next</span></a></li>
                            <?php
                            } else { ?>
                                 <li class="page-item disabled"><a class="page-link" href='#'aria-label="Next" tabindex="-1">
                                    <span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>
                                    <span class="sr-only">Next</span></a></li>
                            <?php } ?>

                        </ul>
                        </nav>

                      <?php } ?>
                      

    </div>
    <!-- /.container-fluid -->

    <script>

      $(document).ready(function(){  

      var checkField;

      //checking the length of the value of message and assigning to a variable(checkField) on load
      checkField = $("input#search").val().length;  

      var enableDisableButton = function(){         
      if(checkField > 0){
          $('#save').removeAttr("disabled");
      } 
      else {
          $('#save').attr("disabled","disabled");
      }
      }        

      //calling enableDisableButton() function on load
      enableDisableButton();            

      $('input#search').keyup(function(){ 
      //checking the length of the value of message and assigning to the variable(checkField) on keyup
      checkField = $("input#search").val().length;
      //calling enableDisableButton() function on keyup
      enableDisableButton();
      });
      });

    </script>

<?php
    // Include config file
    include "footer.php";
?>