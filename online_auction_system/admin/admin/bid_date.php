<?php
session_start();
include '../connection/dbconnection.php';
include 'admin_header.php';

// Check if the product_id is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query to fetch product details based on product_id
    $qryFetchProduct = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($con, $qryFetchProduct);

    if ($result->num_rows > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // Product not found
        echo "<p>Product not found</p>";
        exit;
    }
} else {
    // Product ID is not provided in the URL
    echo "<p>Product ID is missing</p>";
    exit;
}

// Calculate the minimum bid amount
$date = $product['date']; // Minimum bid amount is the product's price

// Handle bid submission
if (isset($_POST['submit_bid'])) {
    $bid_date = $_POST['bid_date'];
    
    // Validate the bid amount
    if ($date =="not declared") {
        $qryUpdateProduct = "UPDATE products SET
                        date = '$bid_date'
                        WHERE product_id = '$product_id'";
                        mysqli_query($con, $qryUpdateProduct);
        echo "<script>alert('Date declared Successfully');</script>";
    } else {
        // Process the bid and insert it into the database
        // You may add the database insertion code here
        // After successful insertion, you can redirect the user or display a success message
        echo "<p>Date has been already  successfully placed.</p>";
    }
}
?> 

<!DOCTYPE html>
<html>

<head>
    <style>
        /* Add your CSS styles for the bid form here */
        .bid-form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .bid-form label {
            display: block;
            margin-bottom: 10px;
        }

        .bid-form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .bid-form button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        <h1>Declare Auction Date</h1>
    </center>
    <div class="bid-form">
        <h2><?php echo $product['product_name']; ?></h2>
        <p>Brand: <?php echo $product['brand']; ?></p>
        <p>Price: $<?php echo $product['price']; ?></p>
        <form method="POST" action="">
            <label for="bid_amount">Enter  Date:</label>
            <input type="date" name="bid_date" class="form-control" id="bid_amount" required min="<?php echo date('Y-m-d'); ?>">
            <button type="submit"class="mt-5" name="submit_bid">Submit Bid</button>
        </form>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
include '../common_footer.php';
?>
