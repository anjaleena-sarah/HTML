<?php
session_start();
include './connection/dbconnection.php';
include './common_header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .body {
            display: flex;
            align-items: center;
            /* background-image: url("./img/bc1.jpg");
            background-size: cover;
            background-position: center; */
            justify-content: center;
            height: 100vh;
            font-family: sans-serif;
            background-image: linear-gradient(to right, #0f0c29, #302b63, #24243e);
        }

        .wrapper {
            width: 350px;
            height: auto;
            padding: 10px 15px;
            margin: 10px 0;
            position: relative;
            border: 1px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(12px);
            border-radius: 20px;
        }

        .wrapper h1 {
            font-size: 25px;
            color: #FFF;
            text-align: center;
        }

        .wrapper .input-box {
            display: flex;
            width: 100%;
            padding: 10px 12px;
            position: relative;
        }

        .wrapper .input-box input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 20px;
            border: none;
            outline: none;
            background: transparent;
            border-bottom: 1px solid #fff;
        }

        input::placeholder {
            color: #FFF;
        }

        .wrapper .input-box .bx {
            position: absolute;
            right: 20px;
            top: 20px;


        }

        .wrapper .remeber {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .wrapper .remeber a {
            text-decoration: none;
        }

        .wrapper .remeber:hover a {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            height: 40px;
            border-radius: 20px;
            outline: none;
            border: none;
            outline: none;
            font-weight: 500;
            box-shadow: 0px 0px 5px black;
            margin-bottom: 10px;
            color: darkslategray;

        }

        input[value="Login"] {
            font-weight: 500;
        }

        .wrapper .register {
            display: inline-flex;
            justify-content: space-around;
            margin-left: 45px;
        }

        .register p,
        a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            word-spacing: 1px;

        }

        .register:hover a {
            text-decoration: underline;
        }
    </style>
</head>

<div class="body">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <div class="wrapper ">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" class="text-light" placeholder="username" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" class="text-light" placeholder="password" name="pass" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remeber">
                <!-- <label><input type="checkbox">Remember Me</label> -->
                <!-- <a href="#">Forget password?</a> -->
            </div>
            <input type="submit" name="login" class="btn " value="Login">
            <div class="register">
                <!-- <p>./icons8-go-back.gif </p> -->
                <!-- <img src="https://icons8.com/icon/xGtnyCEIrmt1/back" alt=""> -->
                <h2>
                    <a href="./index.html"><i class="bi bi-arrow-bar-left"></i><h6 style="color:white">Back to Home</h6></a>
                </h2>
            </div>
        </form>
        <!-- <div style="margin-top:100px;"></div> -->
    </div>
    <!-- <div style="margin-top:100px;"></div> -->
</div>
    <?php

    if (isset($_REQUEST['login'])) {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['pass'];
        $qry = "SELECT * FROM login WHERE `username` = '$email' AND `password` = '$password'";
        echo $qry;
        $result = mysqli_query($con, $qry);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            $uid = $data['reg_id'];
            $type = $data['l_type'];
            $status = $data['l_status'];

            $_SESSION['lid'] = $uid;
            $_SESSION['type'] = $type;

            if ($type == "admin"&& $status == "approved") {
                echo "<script>alert('Log in Successful');</script>";
                echo "<script>window.location='./admin/admin_home.php'</script>";
            } elseif ($type == "user" && $status == "approved") {
                echo "<script>alert('User log in Successful');</script>";
                echo "<script>window.location='./user/user_home.php'</script>";
            } elseif ($type == "seller" && $status == "approved") {
                echo "<script>alert('Log in Successful');</script>";
                echo "<script>window.location='./seller/seller_home.php'</script>";
            }
             elseif ($type == "delivery" && $status == "approved") {
                echo "<script>alert('Log in Successful');</script>";
                echo "<script>window.location='./dboy/dboy_home.php'</script>";
            }
            //  elseif ($type == "parent") {
            //     echo "<script>alert('Log in Successful');</script>";
            //     echo "<script>window.location='./parent/parent_home.php'</script>";
            // }
        } else {
            echo "<script>alert('Invalid User ');</script>";
            echo "<script>window.location='login.php'</script>";
        }
    }
    ?>
</div>

</html>