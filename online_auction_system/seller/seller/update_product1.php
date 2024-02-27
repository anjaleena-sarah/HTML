<?php
session_start();
include '../connection/dbconnection.php';
include 'seller_header.php';

// Check if product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query to fetch product details based on product_id
    $qryFetchProduct = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($con, $qryFetchProduct);

    if ($result->num_rows > 0) {
        $product = mysqli_fetch_assoc($result);

        if (isset($_POST['update'])) {
            $product_name = $_POST['product_name'];
            $brand = $_POST['brand'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            // $date = $_POST['date'];

            // Check if a new image file is provided
            if (!empty($_FILES['file']['name'])) {
                $filename = $_FILES["file"]["name"];
                $tempname = $_FILES["file"]["tmp_name"];
                $folder = "image/" . $filename;

                // Move the uploaded file to the "images" folder
                if (move_uploaded_file($tempname, '../images/' . $filename)) {
                    // Update product details with the new image file
                    $qryUpdateProduct = "UPDATE products SET
                        product_name = '$product_name',
                        brand = '$brand',
                        image = '$filename',
                        description = '$description',
                        price = '$price'
                        
                        WHERE product_id = '$product_id'";

                    if ($con->query($qryUpdateProduct)) {
                        echo "<script>alert('Product updated successfully.');
                        window.location = 'update_product.php';</script>";
                    } else {
                        echo "<script>alert('Failed to update product.');
                        window.location = 'update_product.php?product_id=$product_id';</script>";
                    }
                }
            } else {
                // Update product details without changing the image file
                $qryUpdateProduct = "UPDATE products SET
                    product_name = '$product_name',
                    brand = '$brand',
                    description = '$description',
                    price = '$price'
                    WHERE product_id = '$product_id'";

                if ($con->query($qryUpdateProduct)) {
                    echo "<script>alert('Product updated successfully.');
                    window.location = 'update_product.php';</script>";
                } else {
                    echo "<script>alert('Failed to update product.');
                    window.location = 'update_product.php?product_id=$product_id';</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Product not found.');
        window.location = 'update_product.php';</script>";
    }
} else {
    echo "<script>alert('Product ID not provided.');
    window.location = 'update_product.php';</script>";
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
    <br>
    <br>
    <br>
    <center>
        <h1>Update Product</h1>
    </center>
    <div style="margin:40px 400px; ">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="Product Name" name="product_name" class="form-control one"
                value="<?php echo $product['product_name']; ?>">
            <input type="text" placeholder="Brand" name="brand" class="form-control one"
                value="<?php echo $product['brand']; ?>">
            <input type="number" placeholder="Price" min="1" name="price" class="form-control one"
                value="<?php echo $product['price']; ?>">
            <!-- <input type="text" placeholder="Price" min="1" name="date" class="form-control one"
                value="<?php echo $product['date']; ?>"> -->
            <input type="file" name="file" class="form-control one">
            <textarea name="description" cols="30" rows="3" class="form-control one"
                placeholder="Description"><?php echo $product['description']; ?></textarea>
            <button type="submit" name="update" class="btn btn-warning mt-5" style="padding:10px 15px;">Update Product</button>
        </form>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
include '../common_footer.php';
?>
