<?php
session_start();
include '../connection/dbconnection.php ';

$uid = $_REQUEST['id'];
$status = $_REQUEST['status'];





$query = "UPDATE login  SET `l_status`='$status' WHERE `reg_id`='$uid'  AND `l_type`='user'";
$result = mysqli_query($con, $query);
// echo $query;
if ($result === TRUE) {
    echo "<script type = \"text/javascript\">
					alert(\"Status Updated\");
					window.location = (\"view_user.php\")
				</script>";
}
