<?php
    session_start();
    include('dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:login.php');
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
    <div class="wrapper"><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>       <?php
                                 include('dbconn.php');
                                 $query=mysqli_query($dbconn,"SELECT * FROM `users` WHERE user_id='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_array($query);
                                 $cid=$row['user_id'];
                                 echo $row['firstname'];
                                ?>'s Shopping Cart
                      </h2>
                      <a class="btn btn-info btn-round" href="user_index.php"><i class="now-ui-icons shopping_basket"></i> &nbsp Shop more items</a>
                      <hr color="info"> 
                
                <div class="col-md-12">
                <br>
            
                <div class="panel panel-info panel-size-custom">
                        <div class="panel-body">



      <?php 
        $user_id = $_SESSION['id'];

        $query3=mysqli_query($dbconn,"SELECT * FROM order_details WHERE user_id='$user_id' AND order_id=''") or die (mysql_error());
        $count2=mysqli_num_rows($query3);
      ?>

  <form method="post" action="user_payment.php">

   

    <h5>[ <small><?php echo $count2;?> </small>] Types of item.</h5>  

      <table class="table table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th width="100">Quantity</th>
                  <th width="100">Price(Rs.)</th>
                  <th width="100">Total(Rs.)</th>
                  <th width="100">Option</th>
                </tr>
              </thead>

              <tbody>

          <?php 
            $query=mysqli_query($dbconn,"SELECT * FROM order_details WHERE user_id='$user_id' and order_id=''") or die (mysqli_error());
            while($row=mysqli_fetch_array($query)){
            $count=mysqli_num_rows($query);
            $prod_id=$row['prod_id'];

            $query2=mysqli_query($dbconn,"SELECT * FROM products WHERE prod_id='$prod_id'") or die (mysqli_error());
            $row2=mysqli_fetch_array($query2);
          ?>

              <tr>
                  <td> <img width="100" height="115" src="uploads/<?php echo $row2['prod_pic1'];?>" alt=""/></td>
                  <td><b><?php echo $row2['prod_name'];?></b><br><br>
                    <?php echo $row2['prod_desc'];
                    ?>
                  </td>
                  <td><br><?php  echo $row['prod_qty']; ?></td>
                  <td><br><?php  echo $row2['prod_price']; ?></td>
                  <td><br><?php echo $row['total'];?></td>
                  <td>     
                    <a href="edit_order_details.php?order_id=<?php echo $row['order_details_id'];?>" ><button class="btn btn-info btn-round" type="button">Update Qty</button></a>
                     <a href="delete_order_details.php?order_id=<?php echo $row['order_details_id'];?>" ><button class="btn btn-danger btn-round" onclick="return confirm('Are you sure you want to delete?')" type="button">Remove</button></a>
                  </td>

                  <?php
                 } ?>

              </tr>
        
              <tr>
                  <td></td>
                  <td></td>
                  <td colspan="2" align="right"><b>Total Price</b></td>
                  <td class="label label-important"> <strong>
                     <?php
                      $result5 = mysqli_query($dbconn,"SELECT sum(total) FROM order_details WHERE user_id='$user_id' and order_id=''");
                      while($row5 = mysqli_fetch_array($result5))
                        { 
                        echo 'RS. '.$row5['sum(total)'];
                        echo '<input type="hidden" name="total" value="'.$row5['sum(total)'].'">';
                        }
                      ?></strong>
                  </td>
                  <td></td>
              </tr>

              </tbody>
          </table>
    

                <?php
              if($count2==0 ){
            ?>

                <script type="text/javascript">
                  alert("Shopping Cart Empty! Add an item.");
                  window.location= "user_index.php";
                </script>

               <?php
              }else{
            ?>
           
                <button  type="submit" id="" onclick="return confirm('Are you sure you want to Checkout?')" name="submit" class="btn btn-success btn-round pull-right" data-toggle="modal" data-target="#myModal">
                <i class="now-ui-icons shopping_bag-16"></i> Check Out</button> 

               <?php
                }
              ?>

            <!-- Modal Core -->
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Shipping Address:</h4>
                  </div>
                  <div class="modal-body">

                      <div class="form-group">
						  House Number:
                      <input type="text" class="form-control" name="shipaddress" placeholder="Complete Address For Delivery Purpose." required/>
						  Street Address:
                      <input type="text" class="form-control" name="shipaddress" placeholder="Complete Address For Delivery Purpose." required/>
						  City:
                      <input type="text" class="form-control" name="shipaddress" placeholder="Complete Address For Delivery Purpose." required/>
					  <br>
                      <select class="btn btn-round dropdown-toggle" size="1" name="state">
                      <option value="Delhi">Delhi</option>
                      <option value="Mumbai">Mumbai</option>
                      <option value="Kolkata">Kolkata</option>
                      <option value="Chandigarh">Chandigarh</option>
                      <option value="Jaipur">Jaipur</option>
                      </select>  
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                    <a><button type="submit" name="submit" class="btn btn-success btn-round"><i class="now-ui-icons shopping_delivery-fast"></i> Submit</button></a>
                  </div>
              </div>
            </div>
            </div>

    </form>


                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>

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
							
					
									
						
						
				
		  
  

