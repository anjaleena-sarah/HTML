<?php
session_start();
include '../connection/dbconnection.php ';

$pid = $_REQUEST['product_id'];
$status = 'Sold';





$query = "UPDATE products  SET `date`='$status' WHERE `product_id`='$pid'";
$result = mysqli_query($con, $query);
// echo $query;
if ($result === TRUE) {
    echo "<script type = \"text/javascript\">
					alert(\"Status Updated\");
					window.location = (\"update_product.php\")
				</script>";
}
