<?php
include('dbconn.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
	
    <meta charset="utf-8" />
    <title>TechLib</title>	
	
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" >
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="assets/style.css" rel="stylesheet"/>
	
</head>

<body class="index-page sidebar-collapse">
	
    <nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent " color-on-scroll="400">
		<div class="container">
            <div class="navbar-translate">
                <a href="admin_index.php" class="navbar-brand">
                    TechLib
                </a>
            </div>
        </div>
    </nav>
               
	
    <div class="wrapper">
        <div class="page-header ">
            <div class="page-header-image" style="background-image: url('images/backg.jpeg');">
                <div class="container">
                    <div class="content-center">
						<br><br><br><br><br><br>
						<img src="images/book.png" width="400" height="400" ><br><br>
                        <h3>Scroll down for the books in stock</h3>
                    </div>
                </div>            				
            </div>
		</div>
		<div class="main">
                <div class="container">
            <div class="section section-basic">
                <div class="container">
                      <h2>All Books</h2>
                      <hr color="info"> 
                <br>
                <div class="col-md-12">
                <br>
            
                <div class="panel panel-success panel-size-custom">
                        <div class="panel-body">

                            <?php
                                      include('dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM products ORDER BY prod_name ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>  
                                 
                                <br>
                                <br>
                                <table id="" class="table table-condensed table-striped">
                                    <tr>
                                      <th>Serial</th>
                                      <th>Book Name</th>
                                      <th>Description</th>
                                      <th>Price(Rs.)</th>
                                      <th>Quantity</th>
                                      <th>Category</th>
                                      <th>Option</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {     
                                              echo "<tr>";
                                                echo "<td>".$res['prod_serial']."</td>";
                                                echo "<td>".$res['prod_name']."</td>";
                                                echo "<td>".$res['prod_desc']."</td>";  
                                                echo "<td>".$res['prod_price']."</td>"; 
                                                $prod_qty=$res['prod_qty'];
                                                
                                                if ($prod_qty<=0){
                                                ?>
                                                 <td><span style="color:red;"><?php echo $res['prod_qty'];?> : Reorder!</span></td>  
                                                 <?php
                                                }else{
                                               ?>
                                               <td><?php echo $res['prod_qty'];?></td>
                                               </ul>
                                               <?php }

                                                echo "<td>".$res['category']."</td>";
                                                echo "<td><a href=\"admin_product_details.php?prod_id=$res[prod_id]\">View</a></td>";
                                              echo "</tr>"; 
                                            }
                                          }?>
                                </table><br><br><br><br>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>

        <footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
					<a href="admin_index.php"> Techlib
					</a>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Designed and Coded by Vaibhav Nanda.
                </div>
            </div>
        </footer>
    </div>
</body>		



	<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

	
</html>
							
					
									
						
						
				
	
					
									