<?php
session_start();
include '../connection/dbconnection.php';
include 'user_header.php';
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
            height: 600px;

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

        .bid-button {
            background-color: #007bff;
            color: white;
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
        $qryFetchProducts = "SELECT * FROM products";
        $result = mysqli_query($con, $qryFetchProducts);

        if ($result->num_rows > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                $product_id = $product['product_id'];
                echo "<div class='product-card'>";
                echo "<img src='../img/" . $product['image'] . "' alt='" . $product['product_name'] . "'>";
                echo "<h2>" . $product['product_name'] . "</h2>";
                echo "<p>Brand: " . $product['brand'] . "</p>";
                echo "<p>Price: $" . $product['price'] . "</p>";
                // echo "<a href='update_product1.php?product_id=$product_id'>Update</a>";
               
                $currentDate = date('Y-m-d');
$productDate = date('Y-m-d', strtotime($product['date']));

$currentDate = date('Y-m-d');
$productDate = date('Y-m-d', strtotime($product['date']));

if ($productDate == $currentDate) {
    echo "<a href='bid_product.php?product_id=$product_id' class='bid-button'>Bid</a>";
    echo "<a href='view_all_bid.php?product_id=$product_id' class='bid-button'>View  All</a>";
} elseif ($product['date'] == 'not declared') {
    echo "not declared";
} elseif ($product['date'] == 'Sold') {
    // echo "<p style='margin-top: -10px; font-size: 100px; color: red;position:relative;'>sold</p>";
    echo "<p style='margin-top: -200px; font-size: 100px; color: red; transform: rotate(-45deg);'>Sold</p>";


} elseif ($productDate < $currentDate){
    echo "Auction Completed";

} elseif ($productDate >$currentDate){
    echo "Comming soon";
} 
else {
    echo "<td>Not Declared</td>";
}


                // echo "<a href='bid_product.php?product_id=$product_id' class='bid-button'>Bid</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products available</p>";
        }
        ?>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
include '../common_footer.php';
?>
