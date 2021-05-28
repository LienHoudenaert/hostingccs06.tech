<?php

    // Initialize the session
    session_start();

    if ($_SESSION["admin"] == '0') {
        header("location: index.php");
    }


    // Include config file
    include "header.php";
    $filtervalue = $_SESSION['filterval'];

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["filter"]))){
            $filtervalue = '';

        } else {
            $param_filtervalue = trim($_POST["filter"]);

            if($param_filtervalue ==  '1') {
                $filtervalue = '1';

            } elseif($param_filtervalue ==  '2') {
                $filtervalue = '2'; 

            }elseif($param_filtervalue ==  '3') {
                $filtervalue = '3'; 
            }
        }
    }
    
    $querycountproblem = mysqli_query($link, "SELECT COUNT(*) AS countproblem FROM tickets WHERE priority = 1");
    $querycountremark = mysqli_query($link, "SELECT COUNT(*) AS countremark FROM tickets WHERE priority = 2");
    $querycountbug = mysqli_query($link, "SELECT COUNT(*) AS countbug FROM tickets WHERE priority = 3");
    $querycount = mysqli_query($link, "SELECT COUNT(*) AS countall FROM tickets");

    $datacountproblem=mysqli_fetch_assoc($querycountproblem);
    $datacountremark=mysqli_fetch_assoc($querycountremark);
    $datacountbug=mysqli_fetch_assoc($querycountbug);
    $datacount=mysqli_fetch_assoc($querycount);

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tickets:</h1>
    <div class="float-right"><p>Probleem &nbsp; <i class="fas fa-square fa-xs" style="color:#e74a3b"></i> &nbsp; Bug &nbsp; <i class="fas fa-square fa-xs" style="color:#f6c23e"></i> &nbsp; Vraag/opmerking &nbsp; <i class="fas fa-square fa-xs" style="color:#4e73df"></i>
    </div>
  </div>

    <div class="dropdown">
        <!-- <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter
        <span class="caret"></span></button> -->
        <form class="form-group form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="width: 30em; position: relative;">
            <select class="form-control" id="filter" name="filter" style="width: 15em;">
                <option value="" <?php if($filtervalue == ""){ echo "selected"; $_SESSION['filterval'] = $filtervalue;} ?>>Geen filter <?php echo "(".$datacount['countall'].")";?></option>
                <option value="1" <?php if($filtervalue == "1"){ echo "selected"; $_SESSION['filterval'] = $filtervalue;} ?>>Probleem <?php echo "(".$datacountproblem['countproblem'].")";?></option>
                <option value="2" <?php if($filtervalue == "2"){ echo "selected"; $_SESSION['filterval'] = $filtervalue;} ?>>Vraag/opmerking <?php echo "(".$datacountremark['countremark'].")";?></option>
                <option value="3" <?php if($filtervalue == "3"){ echo "selected"; $_SESSION['filterval'] = $filtervalue;} ?>>Bug <?php echo "(".$datacountbug['countbug'].")";?></option>
            </select>
            <input class="form-control btn btn-primary" style="width: 8em; margin-left: 8px;" type="submit" name="submit" value="Filter">
        </form>
        
    </div>
    
    
    </br>
            <?php

            
                if($filtervalue == '1' || $filtervalue == '2' || $filtervalue =='3'){
                    $query = mysqli_query($link, "SELECT * FROM tickets WHERE priority = $filtervalue ORDER BY created_at ASC");
                    $queryempty = mysqli_query($link, "SELECT * FROM tickets WHERE priority = $filtervalue ORDER BY created_at ASC");
                    $c = 0;
                    while ($row = mysqli_fetch_array($query)) {
                        
                        $id[$c] = $row['id'];
                        $tname[$c] = $row['name'];
                        $email[$c] = $row['email'];
                        $username[$c] = $row['username'];
                        $subject[$c] = $row['subject'];
                        $priority[$c] = $row['priority'];
                        $message[$c] = $row['message'];
                        $date[$c] = $row['created_at'];
                        
                        $c++;
                    }

                    $filtervalue='0';

                } else {

                    $query = mysqli_query($link, "SELECT * FROM tickets ORDER BY created_at ASC");
                    $queryempty = mysqli_query($link, "SELECT * FROM tickets ORDER BY created_at ASC");

                    $c = 0;
                    while ($row = mysqli_fetch_array($query)) {
                        
                        $id[$c] = $row['id'];
                        $tname[$c] = $row['name'];
                        $email[$c] = $row['email'];
                        $username[$c] = $row['username'];
                        $subject[$c] = $row['subject'];
                        $priority[$c] = $row['priority'];
                        $message[$c] = $row['message'];
                        $date[$c] = $row['created_at'];
                        
                        $c++;
                    }

                }
                
                if(empty(mysqli_fetch_array($queryempty))) {?>

                <h4>Geen <?php if($filtervalue == '1'){ echo "probleem";} elseif($filtervalue == '2'){ echo "vraag/opmerking";} elseif($filtervalue == '3'){ echo "bug";} ?> ticket gevonden!</h4>
                <?php

                } else { 

                if ($_GET["start"] > 0) {
                    $start = $_GET["start"];
                }else{
                $start = 0;}

                $showresults = 3;
                $end = $start + $showresults;
                $countresult = $c;
                if ($end > $countresult){
                    $end = $countresult;
                }
                for ($i=$start; $i<$end; $i++) { ?>


                    <div class="card <?php if($priority[$i] == '1') { echo "border-danger mb-3"; } elseif($priority[$i] == '2') { echo "border-primary mb-3"; } elseif($priority[$i] == '3') {echo "border-warning mb-3"; } ?>">
                    <div class="card-header">
                        <strong><?php echo $subject[$i]?></strong>
                        <div class= "float-right"><?php echo $date[$i]?></div>
                    </div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $tname[$i] . " - " . $username[$i]?></h6>
                            <p class="card-text"><?php echo $message[$i]?></p>
                            <a href="mailto:<?php echo $email[$i]?>" class="card-link">Antwoorden</a>
                            <a href="delticket.php?id=<?php echo $id[$i]?>" class="card-link">Ticket verwijderen</a>  
                        </div>
                    </div>
                    <br>

                    <?php $tickets = $_SESSION['tickets'];
                             
                             if($tickets == '1'){ ?>

                              <div style="position: absolute; top: 80px; right: 8px;">
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Gelukt!</strong> Het ticket is verwijderd.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              </div>

                             <?php $_SESSION['tickets'] = '-1'; } elseif($tickets == '0') { ?>

                              <div style="position: absolute; top: 80px; right: 8px;">
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Mislukt!</strong> Het ticket is niet verwijderd.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                                </div>
                              </div>

                             <?php $_SESSION['tickets'] = '-1'; } ?>
                
                <?php   
                }
                ?>

              <nav aria-label="Page navigation">
              <br>
                <ul class="pagination">
                <?php
                    $pages = ($countresult / $showresults);
                    if ($start > 0){ ?>
                        <li class="page-item">
                            <a class="page-link" href='tickets.php?start=<?php echo ($start - $showresults); ?>'aria-label="Previous">
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
                    
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"tickets.php?start=".($p * $showresults)."\">".($p + 1)."</a><li>";
                        }

                    if ($end < $countresult){ ?>
                        <li class="page-item"><a class="page-link" href='tickets.php?start=<?php echo ($start + $showresults); ?>'aria-label="Next">
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
                <?php   
                }
                ?>

</div>
    <!-- /.container-fluid -->

<?php
    // Include config file
    include "footer.php";
?>