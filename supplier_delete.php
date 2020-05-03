
<?php
include('dbconn.php');
$id = $_GET['supp_id'];
$result = mysqli_query($dbconn, "DELETE FROM supplier WHERE supp_id=$id");
header("Location:admin_panel.php");
?>
    