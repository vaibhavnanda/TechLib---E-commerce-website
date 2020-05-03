<?php
    session_start();

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:login.php');
        exit();
    }
?>




                        <?php

                        include('dbconn.php');
                        $prod_id=$_GET['prod_id'];
                        $query = "SELECT * FROM products WHERE prod_id='$prod_id'";
                        $result = mysqli_query($dbconn,$query);
                        while($res = mysqli_fetch_array($result)){

                                    $prod_id=$res['prod_id'];
                                    $prod_price=$res['prod_price'];
                                    $user_id = $_SESSION['id'];


                                    if (isset($_POST['submit'])){

                                        $prod_id=$prod_id;
                                        $prod_price=$prod_price;
                                        $prod_qty = $_POST['prod_qty'];                                       
                                        $total = $prod_price * $_POST['prod_qty'];         
                                        $user_id = $user_id;

                                        $date=date("Y-m-d");


                                        if(empty($prod_qty)){    
            
                                            if(empty($prod_qty)) {
                                            echo "<br><center><h4><font color='red'><b>Error!</b> Enter Product Quantity.</font></h4></center>";
                                        }

                                        } else {

                                        mysqli_query($dbconn,"INSERT INTO order_details (prod_id,prod_qty,total,user_id) 
                                                VALUES ('$prod_id','$prod_qty','$total','$user_id')") or die(mysql_error());
                                            ?>
                                         
                                            <script type="text/javascript">
                                                alert("Product Added To Cart!");
                                                window.location = "user_cart.php";
                                            </script>
   
                                            <?php 
                                        }
                                        }
                                            } ?>

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
	
    <nav class="navbar navbar-expand-lg bg-info fixed-top  " color-on-scroll="400">
		<div class="container">
            <div class="navbar-translate">
                <a href="user_index.php" class="navbar-brand">
                    TechLib
                </a>
			</div>
		</div>
	</nav>
	
<div class="wrapper">
<br>
<div class="main">
    <div class="section section-basic">

    <div class="section" id="carousel">
        <div class="container">
            <h2>Product Details</h2><hr color="info">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-8">
                    
<?php
    include('dbconn.php');
    $prod_id=$_GET['prod_id'];
    $query = "SELECT * FROM products WHERE prod_id='$prod_id'";
    $result = mysqli_query($dbconn,$query);
    while($res = mysqli_fetch_array($result)) {  
    
?>   
                
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <?php if($res['prod_pic1'] != ""): ?>
                          <center>  <img class="d-block" src="uploads/<?php echo $res['prod_pic1']; ?>" alt="First slide" ></center>
                            <?php else: ?>
                          <center>  <img src="uploads/default.png"></center>
                            <?php endif; ?>
                            
                        </div>
                        <div class="carousel-item">
                            <?php if($res['prod_pic2'] != ""): ?>
                          <center>  <img class="d-block" src="uploads/<?php echo $res['prod_pic2']; ?>" alt="Second slide"></center>
                            <?php else: ?>
                          <center>  <img src="uploads/default.png"></center>
                            <?php endif; ?>
                          
                        </div>
                        <div class="carousel-item">
                            <?php if($res['prod_pic3'] != ""): ?>
                           <center> <img class="d-block" src="uploads/<?php echo $res['prod_pic3']; ?>" alt="Third slide"></center>
                            <?php else: ?>
                           <center> <img src="uploads/default.png"></center>
                            <?php endif; ?>
                         
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <i class="now-ui-icons arrows-1_minimal-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <i class="now-ui-icons arrows-1_minimal-right"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>

        <h5><br><br>
        <ul><b>Serial number: 
        <span style="color:green;"><?php echo $res['prod_serial']; ?></span></b>
        </ul>
        <ul><b>Book name: </b> 
        <?php echo $res['prod_name']; ?>
        </ul>
        <ul><b>Description: </b>
        <?php echo $res['prod_desc']; ?>
        </ul>
        <ul><b>Type: </b>
        <?php echo $res['category']; ?>
        </ul>
        <ul><b>Price: </b>
        <?php echo 'Rs.'.$res['prod_price'].''; ?>
        </ul>
        <ul>
        <?php  $prod_qty=$res['prod_qty'];?> 
        <?php
        if ($prod_qty==0){
        ?>
         <span style="color:red;">Product Sold Out!</span>   
         <?php
        }else{
       ?>
       <b>Items in stock: </b><?php echo $res['prod_qty'];?>
       </ul>
       <?php 
    }
?>
        <?php }?>
        </h5>

  <button class="btn btn-info btn-round pull-right" data-toggle="modal" data-target="#myModal">
      <i class="now-ui-icons shopping_cart-simple"></i>Add To Cart</button>
	  
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="form group">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Enter Quantity:</h4>
                  </div>
                  <div class="modal-body">

                    <div class="input-append">
                        <?php
                            echo "<select class='btn btn-round dropdown-toggle' size='1' name='prod_qty' id='prod_qty'>";
                            $i=1; $prod_qty=$prod_qty;
                            while ($i <= $prod_qty ){
                                echo "<option value=".$i.">".$i."</option>";
                                $i++;
                            }
                            echo "</select>";
                        ?>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    <a><button type="submit" name="submit" class="btn btn-success btn-round">Order</button></a>
                  </div>
                </div>
                </form>

              </div>
            </div>
            </div>

    </div>
</div>


        <br>
       </div>
        </div>
    </div>
</div>	

        <footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
					<a href="user_index.php"> Techlib
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
							
					
									
						
						
				
		  
  
