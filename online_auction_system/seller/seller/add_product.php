<?php
session_start();
include '../connection/dbconnection.php';
include 'seller_header.php';
$uid = $_SESSION['lid'];


if (isset($_REQUEST['add'])) {
    $product_name = $_REQUEST['product_name'];
    $brand = $_REQUEST['brand'];
    $description = $_REQUEST['description'];
    $price = $_REQUEST['price'];

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "image/" . $filename;

    if (move_uploaded_file($tempname, '../img/' . $filename)) {
        $qryCheck = "SELECT COUNT(*) AS cnt FROM products WHERE product_name='$product_name'";
        $qryOut = mysqli_query($con, $qryCheck);
        $fetchData = mysqli_fetch_array($qryOut);

        if ($fetchData['cnt'] > 0) {
            echo "<script>alert('Product already exists.');
                 window.location = 'add_product.php';
                </script>";
        } else {
            $qryAddProduct = "INSERT INTO `products`(`product_name`, `brand`, `image`, `description`, `price`,`sid`)
                             VALUES ('$product_name', '$brand', '$filename', '$description', '$price','$uid')";
            // echo $qryAddProduct;
            if ($con->query($qryAddProduct)) {
                echo "<script>alert('Product added successfully.');
                window.location = 'add_product.php';</script>";
            } else {
                echo "<script>alert('Failed to add product.');
                window.location = 'add_product.php';</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
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
        margin-top: 10px;

    }

        ::placeholder {
            color: white !important;
        }

        .one:focus {
            color: rgb(194, 234, 91);
            background-color: #525350f0;
            border: none;
            border-radius: 20px;
        }

        /* .btn {
            font-size: 20px;
            color: white !important;
            box-shadow: 30px 40px 36px -9px rgba(0, 0, 0, 0.75);
            margin-bottom: 20px;
            background-color: #eb5234;
            border: none;
            border-bottom: 1px solid white;
            border-left: 1px solid white;
            border-radius: 20px;
        } */

        .btn:hover {
            background-color: #eb3239;
        }
    </style>
</head>

<body style="background-color:black;">
    <br>
    <br>
    <br>
    <center>
        <h1 class="mt-5">Add Product</h1>
    </center>
    <div style="margin:40px 400px; ">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Product Name" name="product_name" class="form-control one">
            <input type="text" placeholder="Type" name="brand" class="form-control one">
            <input type="number" placeholder="Current Bid" min="1" name="price" class="form-control one">
            <!-- <input type="date" placeholder="Bid date" min="1" name="price" class="form-control one"> -->
            <input type="file" name="file" class="form-control one">
            <textarea name="description" cols="30" rows="3" class="form-control one" placeholder="Description"></textarea>
            <button type="submit" name="add" class="btn btn-success mt-5" style="padding:10px 15px;">Add Product</button>
        </form>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
?>
