<?php
session_start();
include '../connection/dbconnection.php';
include 'user_header.php';
$uid= $_SESSION['lid'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Online Auction</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/gijgo.css">
    <link rel="stylesheet" href="../css/nice-select.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/slicknav.css">

    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="index.html">
                                        <!-- <img src="../img/logo.png" alt=""> -->
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="./user_home.php">home</a></li>
                                            <li><a href="./view_product.php">view product</a></li>

                                            <li><a href="./chat.php">chat</a></li>
                                          
                                            
                                            
                                           
                                                                                       <li><a href="../index.html">logout</a></li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="buy_tkt">
                                    <div class="book_btn d-none d-lg-block">
                                        <a href="#">Buy Tickets</a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
   

    <div class="program_details_area detials_bg_1 overlay2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80  wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                        <h3>Auction Details</h3>
    <li><a href="./chat.php">chat</a></li>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="program_detail_wrap">
                        <!-- lllllllllllllllllllllllllllllllllllllllll -->
                        <?php
$qryFetchProducts = "SELECT
p.product_id,
p.product_name,
p.brand,
p.image,
p.description,
p.price,
p.date AS product_date,
CASE
    WHEN b.status IS NOT NULL THEN 'Sold'
    ELSE 'Not Declared'
END AS product_status,
b.bid,
b.u_id AS winning_user_id,
u.first_name AS winning_user_name,
b.status AS bid_status
FROM products p
LEFT JOIN (
SELECT
    p_id,
    MAX(rate) AS max_rate
FROM bidtable
GROUP BY p_id
) b_max ON p.product_id = b_max.p_id
LEFT JOIN bidtable b ON p.product_id = b_max.p_id AND b.rate = b_max.max_rate
LEFT JOIN user_registration u ON b.u_id = u.user_id
ORDER BY p.product_id DESC;
";
$result = mysqli_query($con, $qryFetchProducts);

if ($result->num_rows > 0) {
    while ($product = mysqli_fetch_assoc($result)) {
        $product_id = $product['product_id'];
        $status = $product['bid_status'];
?>
        <div class="single_propram">
            <div class="inner_wrap">
                <div class="circle_img"></div>
                <div class="porgram_top">
                    <span class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s"><?php echo $product['brand']; ?></span>
                    <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s"><?php echo $product['product_name']; ?></h4>
                </div>
                <div class="thumb wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
                    <img src="../img/<?php echo $product['image']; ?>" alt="">
                </div>
                <h4 class="wow fadeInUp"  data-wow-duration="1s" data-wow-delay=".6s"><?php echo $product['winning_user_name']; ?></h4>
                <!-- <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s"><?php echo $product['product_status']; ?></h4> -->
                <h4 class="wow fadeInUp" data-wow-duration="1s" data-wow-delay=".6s"><?php echo $product['product_date']; ?></h4>
                
                <!-- Payment button with condition -->
                <?php if ($uid == $product['winning_user_id'] && $product['bid_status'] ==''): ?>
                    <!-- <button class="btn btn-outline-danger">Pay Now</button> -->
                    <!-- <div style="background-color:rgba(20,25,250,0.5);"> -->
                    <a href="payment.php?product_id=<?php echo $product_id;?>" class='btn btn-outline-danger'>Pay Now</a>
                <!-- </div> -->
                <?php endif; ?>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
<?php
    }
}
?>


                        <!-- llllllllllllllllllllllllllll -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <!-- JS here -->
    <script src="../js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/isotope.pkgd.min.js"></script>
    <script src="../js/ajax-form.js"></script>
    <script src="../js/waypoints.min.js"></script>
    <script src="../js/jquery.counterup.min.js"></script>
    <script src="../js/imagesloaded.pkgd.min.js"></script>
    <script src="../js/scrollIt.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/gijgo.min.js"></script>
    <script src="../js/nice-select.min.js"></script>
    <script src="../js/jquery.slicknav.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/tilt.jquery.js"></script>
    <script src="../js/plugins.js"></script>



    <!--contact js-->
    <script src="../js/contact.js"></script>
    <script src="../js/jquery.ajaxchimp.min.js"></script>
    <script src="../js/jquery.form.js"></script>
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/mail-script.js"></script>


    <script src="../js/main.js"></script>
</body>

</html>