<?php
session_start();
include '../CONNECTION/DbConnection.php';

$uid = $_SESSION['lid'];
if (isset($_REQUEST['name']) && isset($_REQUEST['id'])) {
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/391827d54c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>IDRIVE</title>
</head>

<body>
    <div class="background-green"></div>
    <div class="main-container">
        <div class="left-container">
            <!-- header -->
            <div class="header">
                <a href="user_home.php" style="font-size: x-large;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </a>
                <div class="nav-icons">
                    <li><i class="fa-solid fa-users"></i></li>
                    <li><i class="fa-solid fa-message"></i></li>
                    <li><i class="fa-solid fa-ellipsis-vertical"></i></li>
                </div>
            </div>

            <!-- notification -->
            <div class="notif-box">
                <i class="fa-solid fa-bell-slash"></i>
                <div class="notif-text">
                    <p>Get Notified of New Messages</p>
                    <a href="#">Turn on Desktop Notifications ›</a>
                </div>
                <i class="fa-solid fa-xmark"></i>
            </div>

            <!-- search-container -->
            <div class="search-container">
                <div class="input">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search or start new chat">
                </div>
                <i class="fa-sharp fa-solid fa-bars-filter"></i>
            </div>

            <!-- chats -->
            <?php
// session_start();
// include '../CONNECTION/DbConnection.php';
// $uid = $_SESSION['lid'];

// Modify the SQL query to exclude the logged-in user
$query = "SELECT * FROM login WHERE reg_id != $uid and username!='admin'";
$res = mysqli_query($con, $query);
?>
<div class="chat-list" id="chatList">
    <?php
    while ($rs = mysqli_fetch_array($res)) {
    ?>
        <a href="Chat.php?id=<?php echo $rs['lid'] ?>&name=<?php echo $rs['username'] ?>" style="text-decoration: none;">
            <div class="chat-box">
                <div class="img-box">
                    <img class="img-cover" src="../img/profile.png" alt="">
                </div>
                <div class="chat-details">
                    <div class="text-head">
                        <h4><?php echo $rs['username'] ?></h4>
                    </div>
                    <div class="text-message">
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>

        </div>
        <div class="right-container">
            <?php
             $iid="select * from login where reg_id='$uid'and l_type='user'";
             $newid = mysqli_query($con, $iid);
             while ($rsw = mysqli_fetch_array($newid)) {
                 $latid=$rsw['lid'];
             }
            if (!empty($id)) {
                $res = mysqli_query($con, "SELECT `login`.*, `chat_messages`.*
                FROM `chat_messages`
                JOIN `login` ON `login`.`reg_id` = '$uid'
                WHERE 
                    (`chat_messages`.`receiver_id` = '$latid' AND `chat_messages`.`sender_id` = '$id')
                    OR
                    (`chat_messages`.`sender_id` = '$latid' AND `chat_messages`.`receiver_id` = '$id')");
                $rs1 = mysqli_fetch_array($res);
            }
            ?>
            <!-- header -->
            <?php
            if (!empty($name) && !empty($id)) {
            ?>
                <div class="header">
                    <div class="img-text">
                        <div class="user-img">
                            <img class="dp" src="assets/images/user.png" alt="">
                        </div>
                        <h4>
                            <?php if (!empty($name)) {
                                echo $name;
                            } ?><br><span>Online</span>
                        </h4>
                    </div>
                    <div class="nav-icons">
                        <li><i class="fa-solid fa-magnifying-glass"></i></li>
                        <li><i class="fa-solid fa-ellipsis-vertical"></i></li>
                    </div>
                </div>

                <!-- chat-container -->
                <div class="chat-container">
                    <?php
                    do {
                        if ($rs1['type'] == "user") {
                    ?>
                            <div class="message-box my-message">
                                <p style="display: flex; flex-wrap: nowrap;">
                                    <?php echo $rs1['message_text']; ?>
                                    <span style="margin-left: 5px; margin-top: 8px;"><?php echo $rs1['timestamp']; ?></span>
                                </p>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="message-box friend-message">
                                <p style="display: flex; flex-wrap: nowrap;">
                                    <?php echo $rs1['message_text']; ?>
                                    <span style="margin-left: 5px; margin-top: 8px;"><?php echo $rs1['timestamp']; ?></span>
                                </p>
                            </div>
                    <?php
                    }
                    } while ($rs1 = mysqli_fetch_array($res))
                    ?>
                </div>
            <?php
            }
            ?>
            <?php
            if (!empty($name) && !empty($id)) {
            ?>
                <form action="" method="post">
                    <!-- input-bottom -->
                    <div class="chatbox-input">
                        <input type="text" name="message" placeholder="Type a message" required>
                        <button type="submit" name="submit" style="border: none; outline: none; margin-right: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" id="send">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchQuery = $(this).val().toLowerCase();
                filterNames(searchQuery);
            });
        });

        function filterNames(query) {
            $('.chat-box').each(function() {
                var productText = $(this).text().toLowerCase();
                if (productText.includes(query)) {
                    $(this).show();
                } else {
                    $("#noMatchingData").show();
                    $(this).hide();
                }
            });
        }
    </script>

    <?php
    include '../CONNECTION/DbConnection.php';

    if (isset($_POST['submit'])) {
        $Message = $_POST['message'];
        date_default_timezone_set("Asia/Kolkata");
        $current_time = date("h:i A");
        $qryReg = "INSERT INTO `chat_messages`(`sender_id`, `receiver_id`, `message_text`, `type`) VALUES ('$uid', '$id', '$Message', 'user')";

        if ($con->query($qryReg) === TRUE) {
            header("Location: Chat.php?id=$id&name=$name");
            exit;
        }
    }
    ?>

</body>
</html>


<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #ccc;
        }

        .background-green {
            position: absolute;
            top: 0;
            width: 100%;
            height: 20%;
            background-color: #009688;
        }

        .main-container {
            position: relative;
            width: 1000px;
            max-width: 100%;
            height: calc(100vh - 40px);
            background: #fff;
            display: flex;
            box-shadow: 0px 1px 1px 0 rgba(0, 0, 0, 0.5), 0px 2px 5px 0 rgba(0, 0, 0, 0.6);
        }

        .main-container .left-container {
            position: relative;
            width: 30%;
            height: 100%;
            flex: 30%;
            background: #fff;
        }

        .main-container .right-container {
            position: relative;
            width: 70%;
            height: 100%;
            flex: 70%;
            background: #e5ddd5;
        }

        .main-container .right-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(https://camo.githubusercontent.com/854a93c27d64274c4f8f5a0b6ec36ee1d053cfcd934eac6c63bed9eaef9764bd/68747470733a2f2f7765622e77686174736170702e636f6d2f696d672f62672d636861742d74696c652d6461726b5f61346265353132653731393562366237333364393131306234303866303735642e706e67);
            opacity: 0.5;
        }

        .header {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            height: 60px;
            background: #ededed;
            padding: 0 15px;
        }

        .user-img {
            position: relative;
            width: 40px;
            height: 40px;
            overflow: hidden;
            border-radius: 50%;
        }

        .dp {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
        }

        .nav-icons {
            display: flex;
            justify-content: flex-end;
            padding-left: 110px;
        }

        .nav-icons li {
            backgroud-color: pink;
            list-style: none;
            display: flex;
            cursor: pointer;
            color: #51585c;
            margin-left: 22px;
            font-size: 18px;
        }

        .notif-box {
            position: relative;
            display: flex;
            width: 100%;
            height: 70px;
            background: #76daff;
            align-items: center;
            font-size: 0.8em;
            text-decoration: none;
        }

        .notif-box i {
            position: relative;
            left: 13px;
            background: #fff;
            padding: 10px;
            width: 42px;
            height: auto;
            font-size: 20px;
            border-radius: 55%;
            cursor: pointer;
            color: #76daff;
        }

        .notif-box .fa-xmark {
            position: absolute;
            left: 260px;
            text-align: center;
            background: #76daff;
            color: #fff;
        }

        .notif-text {
            margin: 25px;
        }

        .notif-text a {
            text-decoration: none;
            color: #333;
            font-size: 0.9em;
        }

        .search-container {
            position: relative;
            width: 100%;
            height: 40px;
            background: #f6f6f6;
            display: flex;
            /*   justify-content: center; */
            align-items: center;
        }

        .search-container .input input {
            width: 121%;
            outline: none;
            border: none;
            background: #fff;
            padding: 5px;
            height: 30x;
            border-radius: 10px;
            font-size: 12px;
            padding-left: 60px;
            margin: 10px
        }

        .search-container .input i {
            position: absolute;
            left: 26px;
            top: 14px;
            color: #bbb;
            font-size: 0.8em;
        }

        .chat-list {
            position: relative;
            height: calc(100% - 170px);
            overflow-y: auto;
        }

        .chat-list .chat-box {
            position: relative;
            width: 100%;
            display: flex;
            /*   justify-content: center; */
            align-items: center;
            cursor: pointer;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .chat-list .chat-box .img-box {
            position: relative;
            width: 55px;
            height: 45px;
            overflow: hidden;
            border-radius: 50%;
        }

        .chat-list .chat-box .chat-details {
            width: 100%;
            margin-left: 10px;
        }

        .chat-list .chat-box .chat-details .text-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2px;
        }

        .chat-list .chat-box .chat-details .text-head h4 {
            font-size: 1.1em;
            font-weight: 600;
            color: #000;
        }

        .chat-list .chat-box .chat-details .text-head .time {
            font-size: 0.8em;
            color: #aaa;
        }

        .chat-list .chat-box .chat-details .text-message {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-list .chat-box .chat-details .text-message p {
            color: #aaa;
            font-size: 0.9em;
            overlay: hidden;
        }

        img {
            width: 100%;
            object-fit: cover;
        }

        .chat-list .chat-box .chat-details .text-message b {
            background: #06e744;
            color: #fff;
            min-width: 20px;
            height: 20px;
            border-radius: 50%;
            /*   text-align: center; */
            font-size: 0.8em;
            font-weight: 400;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .chat-list .active {
            background: #ebebeb;
        }

        .chat-list .chat-box:hover {
            background: #f5f5f5;
        }

        .chat-list .chat-box .chat-details .text-head .unread {
            color: #06e744;
        }


        /* right-container */


        .right-container .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .right-container .header .img-text .user-img .dp {
            position: relative;
            top: -2px;
            left: 0px;
            width: 40px;
            height: auto;
            overflow: hidden;
            object-fit: cover;
        }

        .right-container .header .img-text {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .right-container .header .img-text h4 {
            font-weight: 500;
            line-height: 1.2em;
            margin-left: 15px;
        }

        .right-container .header .img-text h4 span {
            font-size: 0.8em;
            color: #555;
        }

        .right-container .header .nav-icons {
            position: relative;
            margin-right: 0px;
            /*   padding: 5px; */
        }

        .right-container .header .nav-icons i {
            padding: 10px;
        }

        .chat-container {
            position: relative;
            width: 100%;
            height: calc(100% - 120px);
            /*60+60*/
            padding: 50px;
            overflow-y: auto;
        }

        .message-box {
            position: relative;
            display: flex;
            width: 100%;
            margin: 5px 0;
        }

        .message-box p {
            position: relative;
            right: 0;
            text-align: right;
            max-width: 65%;
            padding: 12px;
            background: #dcf8c6;
            border-radius: 10px;
            font-size: 0.9em;
        }

        .message-box.my-message p::before {
            content: '';
            position: absolute;
            top: 0;
            right: -12px;
            width: 20px;
            height: 20px;
            background: linear-gradient(135deg, #dcf8c6 0%, #dcf8c6 50%, transparent 50%, transparent);
        }

        .message-box p span {
            display: block;
            margin-top: 5px;
            font-size: 0.8em;
            opacity: 0.5;
        }

        .my-message {
            justify-content: flex-end;
        }

        .friend-message p {
            background: #fff;
        }

        .friend-message {
            justify-content: flex-start;

        }

        .chat-container .my-message i {
            color: yellow;
        }

        .message-box.friend-message::before {
            content: '';
            position: absolute;
            top: 0;
            left: -12px;
            width: 20px;
            height: 20px;
            background: linear-gradient(225deg, #fff 0%, #fff 50%, transparent 50%, transparent);
        }

        .chatbox-input {
            position: relative;
            width: 100%;
            height: 60px;
            background: #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chatbox-input i {
            cursor: pointer;
            font-size: 1.8em;
            color: #515855;
        }

        .chatbox-input i:nth-child(1) {
            margin: 15px;
        }

        .chatbox-input i:last-child {
            margin-right: 25px;
        }

        .chatbox-input input {
            position: relative;
            width: 90%;
            margin: 0 20px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 1em;
            border: none;
            outline: none;
        }
    </style>
</html>