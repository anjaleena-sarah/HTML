<?php
session_start();
include '../connection/dbconnection.php ';
$uid = $_SESSION['lid'];
echo $uid;
$id = $_REQUEST['id'];
$status = $_REQUEST['status'];





$query = "UPDATE products SET `d_status`='$status', `d_id`= '$uid' WHERE `product_id`='$id'";

echo $query;
$result = mysqli_query($con, $query);
// echo $query;
if ($result === TRUE) {
    echo "<script type = \"text/javascript\">
					alert(\"Status Updated\");
					window.location = (\"viewproduct.php\")
				</script>";
}
