<?php
    session_start();
    include('dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:admin_login_page.php');
        exit();
    }
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
    <div class="wrapper">
        <div class="page-header ">
            <div class="page-header-image" style="background-image: url('images/backg.jpeg');">
                <div class="container">
                    <div class="content-center">
						<br><br><br><br><br><br>
						<img src="images/book.png" width="400" height="400" ><br><br>
                
                    </div>
                </div>            				
            </div>
		</div>

<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>Customer Orders</h2>
                      <hr color="info">
                      <a href='admin_panel.php' class='btn btn-info btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

                <br>
            
                <div class="panel panel-info panel-size-custom">
                        <div class="panel-body">








<?php
                                      include('dbconn.php');

                                      $action = isset($_GET['action']) ? $_GET['action'] : "";
                                      if($action=='deleted'){
                                          echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
                                      $query = "SELECT * FROM order ORDER BY order_date ASC";
                                      $result = mysqli_query($dbconn,$query);
                                      ?>  
                                 
                                <br>
                                <br>
                                <table id="" class="table table-condensed table-striped">
                                    <tr>
                                      <th>Tracking number</th>
                                      <th>Customer</th>
                                      <th>Order date</th>
                                      <th>Shipping Address</th>
                                      <th>Contact</th>
                                      <th>Email</th>
                                      <th>Total price(Rs.)</th>
                                      <th>Tax(Rs.)</th>
                                      <th>Status</th>
                                    </tr>
                                        <?php
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {     
                                              echo "<tr>";
                                                echo "<td>".$res['track_num']."</td>";
                                                echo "<td>".$res['firstname'].' '.$res['middlename'].' '.$res['lastname']."</td>";
                                                echo "<td>".$res['order_date']."</td>"; 
                                                echo "<td>".$res['shipping_add']."</td>";  
                                                echo "<td>".$res['contact']."</td>"; 
                                                echo "<td>".$res['email']."</td>"; 
                                                echo "<td>".$res['totalprice']."</td>"; 
                                                echo "<td>".$res['tax']."</td>";
                                                echo "<td>".$res['status']."</td>";
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
				
