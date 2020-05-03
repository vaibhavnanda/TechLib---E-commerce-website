
<?php
include("dbconn.php");
$id = $_GET['user_id'];
$result = mysqli_query($dbconn, "DELETE FROM users WHERE user_id=$id");
header("Location:admin_panel.php");
?>
    