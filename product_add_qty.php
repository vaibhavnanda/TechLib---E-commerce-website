<?php
  session_start();

  if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
    header('location: admin_index.php');
    exit();
  }
?>


<?php

include("dbconn.php");
if(isset($_POST['submit']))
{   
    $prod_id = mysqli_real_escape_string($dbconn, $_POST['prod_id']);

    $prod_name=$_POST['prod_name'];
    $prod_desc=$_POST['prod_desc'];
    $prod_qty=$_POST['prod_qty'];
    $prod_cost=$_POST['prod_cost'];
    $prod_price=$_POST['prod_price'];
    $category=$_POST['category'];
    $supplier=$_POST['supplier'];
    $prod_serial=$_POST['prod_serial'];

   
        if(empty($prod_qty)) {
            echo "<font color='red'>Product Quantity field is empty!</font><br/>";
        
        } else {    


        $query = "UPDATE products SET prod_qty=prod_qty+'$prod_qty' WHERE prod_id=$prod_id";

        $result = mysqli_query($dbconn,$query);
       
       if($result){
            
            $prod_name = $_POST['prod_name'];
            $prod_qty = $_POST['prod_qty'];
            
            date_default_timezone_set('Asia/Kolkata');

            $date = date("Y-m-d H:i:s");
            $id=$_SESSION['id'];
            
            $query=mysqli_query($dbconn,"SELECT * FROM products WHERE prod_id='$prod_id'")or die(mysqli_error());
          
                while($res=mysqli_fetch_array($query)){
                $prod_name=$res['prod_name'];
                $remarks="added $prod_qty of $prod_name";  
            }
                mysqli_query($dbconn,"INSERT INTO logs (user_id,action,date) VALUES ('$id','$remarks','$date')")or die(mysqli_error($dbconn));

        header("Location: admin_panel.php");
        }
        
    }
}
?>
            


<?php
    $prod_id=isset($_GET['prod_id']) ? $_GET['prod_id'] : die('ERROR: Record ID not found.');

    $result = mysqli_query($dbconn, "SELECT * FROM products WHERE prod_id=$prod_id");
        while($res = mysqli_fetch_array($result))
        {
            $prod_name = $res['prod_name'];
            $prod_desc = $res['prod_desc'];
            $prod_qty = $res['prod_qty'];
            $prod_cost = $res['prod_cost'];
            $prod_price = $res['prod_price'];
            $category = $res['category'];
            $supplier = $res['supplier'];
            $prod_serial = $res['prod_serial'];
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

<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>Add Book Information</h2>
                      <hr color="info">
                      <a href='admin_panel.php' class='btn btn-info btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">
               
    <div class="panel panel-info panel-size-custom">
  <div class="panel-heading"><h3>Add Book Quantity</h3></div>
  <div class="panel-body">
    <form action="product_add_qty.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value=<?php echo $_GET['prod_id'];?>>
            <label for="prod_name" id="prod_name" name="prod_name">Product Name: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $prod_name;?></label><br><br>
            <label for="prod_serial">Product Serial: &nbsp &nbsp &nbsp <?php echo $prod_serial;?></label><br><br>
            <label for="prod_name">Name: &nbsp &nbsp &nbsp <?php echo $prod_name;?></label><br><br>
            <label for="prod_desc">Description: &nbsp &nbsp &nbsp <?php echo $prod_desc;?></label><br><br>
            <label for="prod_price">Product Cost (Rs.): &nbsp &nbsp &nbsp &nbsp <?php echo $prod_price;?></label><br><br>
            <label for="category">Product Supplier: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $category;?></label><br><br>
            <label for="supplier">Product Category: &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $supplier;?></label><br><br>
            <label for="qty">Available Quantity: &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $prod_qty;?></label><br><br>
            <label for="prod_qty">Number of Books to be added:</label>
            <input type="text" class="form-control" id="prod_qty" name="prod_qty" placeholder="Quantity">
        </div>
        <br/>
        <div class="form group">
            <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
            <i class="now-ui-icons ui-1_check"></i> Add Quantity
            </button> 
        </div>
    </form>
  
  </div>
</div>
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
				

