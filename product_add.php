<?php
    session_start();
    include('dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
    header('location: admin_login_page.php');
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

<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>Add Book Information</h2>
                      <hr color="info">
                      <a href='admin_panel.php' class='btn btn-info btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">
               

<?php
// including the database connection file
include("dbconn.php");
if(isset($_POST['submit'])){

    $prod_name=$_POST['prod_name'];
    $prod_desc=$_POST['prod_desc'];
    $prod_qty=$_POST['prod_qty'];
    $prod_cost=$_POST['prod_cost'];
    $prod_price=$_POST['prod_price'];
    $category=$_POST['category'];
    $supplier=$_POST['supplier'];
    $prod_serial=$_POST['prod_serial'];

    move_uploaded_file($_FILES["prod_pic1"]["tmp_name"],"uploads/" . $_FILES["prod_pic1"]["name"]);         
    $prod_pic1=$_FILES["prod_pic1"]["name"];
    move_uploaded_file($_FILES["prod_pic2"]["tmp_name"],"uploads/" . $_FILES["prod_pic2"]["name"]);         
    $prod_pic2=$_FILES["prod_pic2"]["name"];
    move_uploaded_file($_FILES["prod_pic3"]["tmp_name"],"uploads/" . $_FILES["prod_pic3"]["name"]);         
    $prod_pic3=$_FILES["prod_pic3"]["name"];

    if(empty($prod_name) || empty($prod_desc) || empty($prod_qty) || empty($prod_cost) || empty($prod_price) || empty($category) 
        || empty($supplier) || empty($prod_serial) || empty($prod_pic1) || empty($prod_pic2) || empty($prod_pic3)){    
            
        if(empty($prod_name)) {
            echo "<font color='red'>Product name field is empty!</font><br/>";
        }
        
        if(empty($prod_desc)) {
            echo "<font color='red'>Product description field is empty!</font><br/>";
        }

        if(empty($prod_qty)) {
            echo "<font color='red'>Quantity field is empty!</font><br/>";
        }   

        if(empty($prod_price)) {
            echo "<font color='red'>Product price field is empty!</font><br/>";
        }   

        if(empty($category)) {
            echo "<font color='red'>Category field is empty!</font><br/>";
        }  

        if(empty($supplier)) {
            echo "<font color='red'>Supplier field is empty!</font><br/>";
        } 

        if(empty($prod_serial)) {
            echo "<font color='red'>Serial field is empty!</font><br/>";
        }

        if(empty($prod_pic1)) {
            echo "<font color='red'>Picture1 field is empty!</font><br/>";
        }

        if(empty($prod_pic2)) {
            echo "<font color='red'>Picture2 field is empty!</font><br/>";
        }

        if(empty($prod_pic3)) {
            echo "<font color='red'>Picture3 field is empty!</font><br/>";
        }

    } else {    

        $query = "INSERT INTO products (prod_name, prod_desc, prod_qty, prod_cost, prod_price, category, supplier, prod_serial, prod_pic1, prod_pic2, prod_pic3) 
        VALUES ('$prod_name','$prod_desc','$prod_qty','$prod_cost','$prod_price','$category','$supplier','$prod_serial','$prod_pic1','$prod_pic2','$prod_pic3')";  

        $result = mysqli_query($dbconn,$query);
            
        if($result){
            
            $prod_name = $_POST['prod_name'];
            $prod_qty = $_POST['prod_qty'];
            
            date_default_timezone_set('Asia/Manila');

            $date = date("Y-m-d H:i:s");
            $id=$_SESSION['id'];
            
            $query=mysqli_query($dbconn,"SELECT prod_name FROM products WHERE prod_id='$prod_name'")or die(mysqli_error());
          
                $row=mysqli_fetch_array($query);
                $product=$row['prod_name'];
                $remarks="added a new product $prod_qty of $prod_name";  
            
                mysqli_query($dbconn,"INSERT INTO logs (user_id,action,date) VALUES ('$id','$remarks','$date')")or die(mysqli_error($dbconn));

        //redirecting to the display page.
        header("Location: admin_panel.php");
        }
        
    }
}

?>

<div class="panel panel-info panel-size-custom">
          <div class="panel-heading"><h3>Add Books: </h3></div>

          <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form group">
                    <label for="prod_name">Book Name:</label>
                    <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Book Name"/>
                    <label for="prod_desc">Book Description:</label>
                    <input type="text" class="form-control" id="prod_desc" name="prod_desc" placeholder="Book Description"/>
                    <label for="prod_cost">Book Cost (Rs):</label>
                    <input type="text" class="form-control" id="prod_cost" name="prod_cost" placeholder="Cost"/>
                    <label for="prod_price">Book Price (Rs):</label>
                    <input type="text" class="form-control" id="prod_price" name="prod_price" placeholder="Price"/>
                    <label for="prod_qty">Quantity:</label>
                    <input type="text" class="form-control" id="prod_qty" name="prod_qty" placeholder="Quantity"/>

                    <div class="form-group">
                        <label for="supplier">Supplier:</label>
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

                        
                        <label for="prod_pic1">Picture 1: </label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="prod_pic1" name="prod_pic1">  
                        </div>
                        <label for="prod_pic2">Picture 2: </label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="prod_pic2" name="prod_pic2">  
                        </div>
                        <label for="prod_pic3">Picture 3: </label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="prod_pic3" name="prod_pic3">  
                        </div>

                    </div>

                    <label for="prod_serial">Serial:</label>
                    <input type="text" class="form-control" id="prod_serial" name="prod_serial" placeholder="Value e.g. 1234"/>

                </div>
                <br>

                <div class="form group">
                    <button type="submit" class="btn btn-info btn-round" id="submit" name="submit">
                    <i class="now-ui-icons ui-1_check"></i> Add Product
                    </button> 
                </div>
            </form>
          </div>
        </div> 
        <br> 
    </div>
</div>
</div>

	        <footer class="footer" data-background-color="black">
	            <div class="container">
	                <nav>
						<a href="home.php"> Techlib
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
			
