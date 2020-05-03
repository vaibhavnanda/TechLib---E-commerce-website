<?php
include("dbconn.php");
if(isset($_POST['update']))
{   
    $id = mysqli_real_escape_string($dbconn, $_POST['prod_id']);
    $prod_name = mysqli_real_escape_string($dbconn, $_POST['prod_name']);
    $prod_desc = mysqli_real_escape_string($dbconn, $_POST['prod_desc']);
    $prod_qty = mysqli_real_escape_string($dbconn, $_POST['prod_qty']);
    $prod_cost = mysqli_real_escape_string($dbconn, $_POST['prod_cost']); 
    $prod_price = mysqli_real_escape_string($dbconn, $_POST['prod_price']); 
    $category = mysqli_real_escape_string($dbconn, $_POST['category']); 
    $supplier = mysqli_real_escape_string($dbconn, $_POST['supplier']);
    $prod_serial = mysqli_real_escape_string($dbconn, $_POST['prod_serial']);

    if(empty($prod_name) || empty($prod_desc) || empty($prod_cost) || empty($prod_price) || empty($supplier) || empty($category) || empty($prod_serial)) {    
            
        if(empty($prod_name)) {
            echo "<font color='red'>Product name field is empty!</font><br/>";
        }
        
        if(empty($prod_desc)) {
            echo "<font color='red'>Product description field is empty!</font><br/>";
        }

        if(empty($prod_cost)) {
            echo "<font color='red'>Product cost field is empty!</font><br/>";
        }
        
        if(empty($prod_price)) {
            echo "<font color='red'>Product price field is empty!</font><br/>";
        }    

        if(empty($supplier)) {
            echo "<font color='red'>Supplier field is empty!</font><br/>";
        }  

        if(empty($category)) {
            echo "<font color='red'>Category field is empty!</font><br/>";
        }  

        if(empty($prod_serial)) {
            echo "<font color='red'>Serial number field is empty!</font><br/>";
        } 
       
    } else {    

        $query = "UPDATE products SET prod_name='$prod_name',prod_desc='$prod_desc',prod_cost='$prod_cost',prod_price='$prod_price',
                supplier='$supplier',category='$category',prod_serial='$prod_serial' WHERE prod_id=$id";
        $result = mysqli_query($dbconn,$query);
        
        if($result){
        header("Location: admin_panel.php");
        }
        
    }
}
?>






<?php
$id=isset($_GET['prod_id']) ? $_GET['prod_id'] : die('ERROR: Record ID not found.');
$result = mysqli_query($dbconn, "SELECT * FROM products WHERE prod_id=$id");
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
  <div class="panel-heading"><h3>Update Book Information</h3></div>
  <div class="panel-body">
    <form action="product_update.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="prod_id" name="prod_id" value=<?php echo $_GET['prod_id'];?>>
            <label for="prod_name">Serial number:</label>
            <input type="text" class="form-control" id="prod_serial" name="prod_serial" value="<?php echo $prod_serial;?>">
            <label for="prod_name">Book Name:</label>
            <input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $prod_name;?>">
            <label for="prod_desc">Book Description:</label>
            <input type="text" class="form-control" id="prod_desc" name="prod_desc" value="<?php echo $prod_desc;?>">
            <label for="prod_cost">Book Cost (Rs.):</label>
            <input type="text" class="form-control" id="prod_cost" name="prod_cost" value="<?php echo $prod_cost;?>">
            <label for="prod_price">Book Price (Rs.):</label>
            <input type="text" class="form-control" id="prod_price" name="prod_price" value="<?php echo $prod_price;?>">
            


                    <div class="form-group">
                        <label for="supp_name">Supplier:</label>
                        <div class="input-group">
                            <select class="form-control" id="supplier" name="supplier" required>
                              <?php
                              include('dbconn.php');
                              $query=mysqli_query($dbconn,"SELECT supp_name FROM supplier ORDER BY supp_name ASC")or die(mysqli_error());
                              while($row=mysqli_fetch_array($query)){
                                  ?>
                                <option value="<?php echo $row['supp_name'];?>"><?php echo $row['supp_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label for="category">Category:</label>
                        <div class="input-group">
                            <select class="form-control" id="category" name="category" required>
                              <?php
                              include('dbconn.php');
                              $query=mysqli_query($dbconn,"SELECT cat_name FROM category ORDER BY cat_name ASC")or die(mysqli_error());
                              while($row=mysqli_fetch_array($query)){
                              ?>
                                <option value="<?php echo $row['cat_name'];?>"><?php echo $row['cat_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label for="prod_qty" id="prod_qty" name="prod_qty">Available Quantity: &nbsp &nbsp <?php echo $prod_qty;?></label>
                    </div>
                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Product
                </button>
            </div>
    </form>
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
				

