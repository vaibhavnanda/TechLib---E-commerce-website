<?php
include("dbconn.php");
if(isset($_POST['update']))
{   
    $supp_id = mysqli_real_escape_string($dbconn, $_POST['supp_id']);
    $supp_name = mysqli_real_escape_string($dbconn, $_POST['supp_name']);
    $supp_address = mysqli_real_escape_string($dbconn, $_POST['supp_address']);
    $supp_contact = mysqli_real_escape_string($dbconn, $_POST['supp_contact']);
    $supp_email = mysqli_real_escape_string($dbconn, $_POST['supp_email']); 

    if(empty($supp_name) || empty($supp_address) || empty($supp_contact) || empty($supp_email)) {    
            
        if(empty($supp_name)) {
            echo "<font color='red'>Supplier name field is empty!</font><br/>";
        }
        
        if(empty($supp_address)) {
            echo "<font color='red'>Address field is empty!</font><br/>";
        }

        if(empty($supp_contact)) {
            echo "<font color='red'>Contact field is empty!</font><br/>";
        }
        
        if(empty($supp_email)) {
            echo "<font color='red'>Email field is empty!</font><br/>";
        }    
       
    } else {    

        $query = "UPDATE supplier SET supp_name='$supp_name',supp_address='$supp_address',supp_contact='$supp_contact',supp_email='$supp_email' WHERE supp_id=$supp_id";
        $result = mysqli_query($dbconn,$query);
        
        if($result){
        header("Location: admin_panel.php");
        }
        
    }
}
?>






<?php
$id=isset($_GET['supp_id']) ? $_GET['supp_id'] : die('ERROR: Record ID not found.');
$result = mysqli_query($dbconn, "SELECT * FROM supplier WHERE supp_id=$id");
while($res = mysqli_fetch_array($result))
{
    $supp_name = $res['supp_name'];
    $supp_address = $res['supp_address'];
    $supp_contact = $res['supp_contact'];
    $supp_email = $res['supp_email'];
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
                      <h2>Add Supplier Information</h2>
                      <hr color="info">
                      <a href='admin_panel.php' class='btn btn-info btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">
					
    <div class="panel panel-info panel-size-custom">
  <div class="panel-heading"><h3>Update Supplier</h3></div>
  <div class="panel-body">
    <form action="supplier_update.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="supp_id" name="supp_id" value=<?php echo $_GET['supp_id'];?>>
            <label for="supp_name">Supplier name:</label>
            <input type="text" class="form-control" id="supp_name" name="supp_name" value="<?php echo $supp_name;?>">
            <label for="supp_address">Address:</label>
            <input type="text" class="form-control" id="supp_address" name="supp_address" value="<?php echo $supp_address;?>">
            <label for="supp_contact">Contact Details:</label>
            <input type="text" class="form-control" id="supp_contact" name="supp_contact" value="<?php echo $supp_contact;?>">
            <label for="supp_email">Email:</label>
            <input type="text" class="form-control" id="supp_email" name="supp_email" value="<?php echo $supp_email;?>">
            

                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Supplier
                </button>
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
				

					
  			
			
