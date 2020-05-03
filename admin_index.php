<?php
    session_start();

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
	
    <nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent " color-on-scroll="400">
		<div class="container">
            <div class="navbar-translate">
                <a href="admin_index.php" class="navbar-brand">
                    TechLib
                </a>	
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                    <span class="navbar-toggler-bar bar4"></span>
                </button>				
	            </div>
	            <div class="collapse navbar-collapse justify-content-end" id="navigation">
	                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_panel.php">
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>
                                <?php
                                 include('dbconn.php');
                                 $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE user_id='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_array($query);
                                 echo 'Admin '.$row['firstname'].'';
                                ?>
                            </p>
                        </a>
                    </li>									
	                    <li class="nav-item">
	                        <a class="nav-link" href="admin_books.php">
	                            <i class="now-ui-icons files_paper"></i>
	                            <p>Books</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="orders.php">
	                            <i class="now-ui-icons shopping_cart-simple"></i>
	                            <p>Orders</p>
	                        </a>
		                    <li class="nav-item">
		                        <a href="logout.php" class="nav-link">
		                            <i class="now-ui-icons ui-1_lock-circle-open"></i>
		                            <p>Logout</p>
		                        </a>
		                    </li>	
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" href="https://twitter.com">
	                            <i class="fa fa-twitter"></i>
								<p class="d-lg-none d-xl-none">Twitter</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" rel="tooltip" href="https://www.facebook.com">
	                            <i class="fa fa-facebook-square"></i>
								<p class="d-lg-none d-xl-none">Facebook</p>
	                        </a>
	                    </li>
                </ul>
            </div>
        </div>
    </nav>	
	
    <div class="wrapper">
        <div class="page-header ">
            <div class="page-header-image" style="background-image: url('images/backg.jpeg');"></div>
                <div class="container">
                    <div class="content-center">
						<br><br><br><br><br><br>
						<img src="images/book.png" width="400" height="400" ><br><br>
                        <h3>We'll sell you all the knowledge you need</h3>
                    </div>
                </div>
            </div>
        </div>	
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    <br>
                    <div class="col-md-12">
                        <center>
                        <label><b>Search Book: </b></label>       
                                <form method="POST" action="admin_search.php" >
                                    <input type="image" title="Search" src="images/search.png" alt="Search" />
                                    <input type="text" name="search" class="search-query" placeholder="Enter Book Name">
                                </form>
                        </center>
                    </div>	
					<br>
					
				  <div class="tab-pane  active" id="">
				    <ul class="thumbnails">
				    <?php
				    $query = "SELECT * FROM products ORDER BY prod_name ASC";
				    $result = mysqli_query($dbconn,$query);
				    while($res = mysqli_fetch_array($result)) {  
				        $prod_id=$res['prod_id'];
    
				?>   
				    <div class="row-sm-3">
				        <div class="thumbnail">
				            <?php if($res['prod_pic1'] != ""): ?>
				            <img src="uploads/<?php echo $res['prod_pic1']; ?>" width="200px" height="300px">
				            <?php else: ?>
				            <img src="uploads/default.jpg" width="200px" height="300px">
				            <?php endif; ?>
				        <div class="caption">
				          <h6><center><b><?php echo $res['prod_name'];?></b></center></h6>
				          <h6><a class="btn btn-success btn-round" title="Click for more details!" href="admin_product_details.php?prod_id=<?php echo $res['prod_id'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a><medium class="pull-right">Rs. <?php echo $res['prod_price']; ?></medium></h6>
				        </div>

				        </div>
				      <hr color="info">
				      </div>
             
				<?php }?> 
				      </ul>
				  </div>
										
					
				</div>
			</div>
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
				
