
<?php

include ("dbconn.php");
$id = $_GET['prod_id'];
$result = mysqli_query($dbconn, "DELETE FROM products WHERE prod_id=$id");
header("Location:admin_panel.php");
?>
    