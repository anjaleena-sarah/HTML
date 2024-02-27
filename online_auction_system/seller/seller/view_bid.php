<?php
session_start();
include '../connection/dbconnection.php';
include 'seller_header.php';
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
        <h1>Product List</h1>
    </center>
    <div style="display: flex; flex-wrap: wrap; justify-content: center;">
    <table class="table table-dark">
        <thead>
            <tr>
                <!-- <th>Bid ID</th> -->
                <!-- <th>User ID</th> -->
                <!-- <th>Product ID</th> -->
                <th class="text-danger">Bid Amount </th>
                <!-- <th>Status</th> -->
                <th>Product Name</th>
                <th>Type</th>
                <!-- <th>Image</th> -->
                <!-- <th>Description</th> -->
                <th>Price</th>
                <th>Date</th>
                <!-- <th>User ID</th> -->
                <th>First Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <!-- <th>Password</th> -->
                <!-- <th>Address</th> -->
            </tr>
        </thead>
        <tbody>
        <?php
        $product_id = $_GET['product_id'];
        $qryFetchProducts = "SELECT * FROM bidtable
    JOIN products ON bidtable.p_id = products.product_id
    JOIN user_registration ON bidtable.u_id = user_registration.user_id
    WHERE bidtable.p_id='$product_id'
    ORDER BY bidtable.rate DESC";
        $result = mysqli_query($con, $qryFetchProducts);

        if ($result->num_rows > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                // Display data in each row
                echo "<tr>";
                // echo "<td>{$product['bid_id']}</td>";
                // echo "<td>{$product['user_id']}</td>";
                // echo "<td>{$product['product_id']}</td>";
                echo "<td class='text-danger'>{$product['rate']}</td>";
                // echo "<td>{$product['status']}</td>";
                echo "<td>{$product['product_name']}</td>";
                echo "<td>{$product['brand']}</td>";
                // echo "<td>{$product['image']}</td>";
                // echo "<td>{$product['description']}</td>";
                echo "<td>{$product['price']}</td>";
                echo "<td>{$product['date']}</td>";
                // echo "<td>{$product['user_id']}</td>";
                echo "<td>{$product['first_name']}</td>";
                echo "<td>{$product['phone_number']}</td>";
                echo "<td>{$product['email']}</td>";
                // echo "<td>{$product['password']}</td>";
                echo "<td class='btn btn-success'><a href='accept.php?product_id=$product_id'>Accept</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='17'>No data available</td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
</body>

</html>

<?php
include '../connection/dbconnection.php';
include '../common_footer.php';
?>
