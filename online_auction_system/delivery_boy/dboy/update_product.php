<?php
session_start();
include '../connection/dbconnection.php';
include 'dboy_header.php';
$uid = $_SESSION['lid'];

?>

<!DOCTYPE html>
<html>

<head>
    <style>
        /* Add your CSS styles for the product cards here */
        .product-card {
            width: 300px;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
        }

        .product-card a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            background-color: #eb5234;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
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
        <h1 style="color:white;">Product List</h1>
    </center>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php
        // Query to fetch bid details along with corresponding product and user details
        $qryFetchBids = "SELECT b.*, p.*, u.*
        FROM bidtable b
        JOIN products p ON b.p_id = p.product_id
        JOIN user_registration u ON b.u_id = u.user_id
        WHERE b.status = 'paid'AND p.d_status = 'selected' and p.d_id='$uid';"; // Assuming you want to fetch bids with a pending status
        $result = mysqli_query($con, $qryFetchBids);

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                echo "<div class='product-card'>";
                echo "<img src='../img/" . $row['image'] . "' alt='" . $row['product_name'] . "'>";
                echo "<h2>" . $row['product_name'] . "</h2>";
                echo "<p>Brand: " . $row['brand'] . "</p>";
                echo "<p>Price: " . $row['price'] . "</p>";
                // Display user details
                echo "<h3>User Details</h3>";
                echo "<p>User Name: " . $row['first_name'] . "</p>";
                echo "<p>Email: " . $row['email'] . "</p>";
                echo "<p>Phone: " . $row['phone_number'] . "</p>";
                // Here you can add a button or link to take orders for delivery
                echo "<a href='take_order.php?id=$product_id&status=delivered'>Delivered</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available</p>";
        }
        ?>
    </div>
</body>

</html>
