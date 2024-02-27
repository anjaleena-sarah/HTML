<?php
session_start();
include '../connection/dbconnection.php';
include 'user_header.php';
$uid= $_SESSION['lid'];


// Check if the product_id is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $MAX="SELECT MAX(rate) AS highest_bid FROM bidtable WHERE p_id = '$product_id'";
    $result = mysqli_query($con, $MAX);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $highest_bid = $row['highest_bid'];
    // echo "The highest bid rate for product $product_id is $highest_bid";
}

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
$minimum_bid = $product['price']; // Minimum bid amount is the product's price

// Handle bid submission
if (isset($_POST['submit_bid'])) {
    $bid_amount = $_POST['bid_amount'];
    
    // Validate the bid amount
    if ($bid_amount < $minimum_bid) {
        echo "<p>Your bid amount cannot be lower than the current price or the starting bid.</p>";
        
    } else {
        $sql = "INSERT INTO bidtable (u_id, p_id, rate)
        VALUES ('$uid', '$product_id', '$bid_amount')";
			// echo $qry;
			mysqli_query($con, $sql);
        // echo "<p>Your bid of $$bid_amount has been successfully placed.</p>";
        echo "<script>alert('Bid Amount has been successfully placed');</script>";
        echo "<script>window.location='./bid_product.php?product_id=$product_id'</script>";
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
        <h1>Bid on Product</h1>
    </center>
    <div class="bid-form">
        <h2><?php echo $product['product_name']; ?></h2>
        <p>Brand: <?php echo $product['brand']; ?></p>
        <p>Price: <?php echo $product['price']; ?></p>
        <p>Last Bid Amount: <?php echo $highest_bid; ?></p>
        <form method="POST" action="">
            <label for="bid_amount">Enter Your Bid Amount:</label>
            <input type="number" name="bid_amount" id="bid_amount" required min="<?php echo $minimum_bid; ?>">
            
                    <!-- <p>Price: $<?php echo $product['date']; ?></p> -->
            <button type="submit" name="submit_bid">Submit Bid</button>
        </form>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
include '../common_footer.php';
?>
