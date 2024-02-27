<?php
session_start();
include './connection/dbconnection.php';
include './common_header.php';
?>
<style>
    .one:focus{
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        color: blue;

    }
    .one{
        background-color: rgba(255, 255, 255,0.5);
padding: 12px 16px;
        border: none;
        color: blue;

    }
::placeholder{
    color: brown!important;
}
</style>

<body style="background-color:plum;">
<h1 style="margin-top:200px; text-align: center;">User Registration</h1>

<div class="row">
    <div class="col-3"></div>
    <div class="col-5">
    <form action="" method="post">
        <br>
        <br>   
    <input type="text" name="name" placeholder="Name" class="form-control one" autofocus required pattern="[A-Za-z\s]+">
    <br>
    <input type="email" name="email" placeholder="Email" class="form-control one" autofocus required>
    <br>
    <input type="text" name="phone" placeholder="Phone" class="form-control one" autofocus required maxlength="10" pattern="[0-9]+">
    <br>
    <input type="password" name="password" placeholder="Password" class="form-control one" autofocus required>
    <br>
    <!-- vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv -->
    <textarea name="address" id="" cols="30" rows="5" class="form-control one" placeholder="Address" required></textarea>
    <br>
    <br>
    <input type="submit" name="add" value="Register" class="btn btn-success">
</form>

</div>
<div class="col-2">

</div>

</div>
</body>
<?php
if (isset($_REQUEST['add'])) {
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	$password = $_REQUEST['password'];
	// $districts = $_REQUEST['districts'];
	$address = $_REQUEST['address'];
	// $password = $_REQUEST['pass'];
	$qry = "SELECT * FROM `login` WHERE `username` = '$email'";
	// echo $qry;
	$result = mysqli_query($con, $qry);
	if ($result->num_rows > 0) {
		$data = $result->fetch_assoc();
        echo "<script>alert('Already added');</script>";}

	else{
        $qry = "insert into user_registration(first_name,
        phone_number,
        email,
        password,
        address)values('$name','$phone','$email','$password','$address' )";
			echo $qry;
			mysqli_query($con, $qry);
            $lqry = "insert into login(`reg_id`,`username`,`password`,`l_type`)values((select max(user_id) from user_registration),'$email','$password','user')";
			mysqli_query($con, $lqry);
			echo $lqry;

    }	
    
}
?>
