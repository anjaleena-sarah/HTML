<?php
session_start();
include '../connection/dbconnection.php';
// include 'seller_header.php';

$uid = $_SESSION['lid'];


$name = '';

if (isset($_REQUEST['name']) && isset($_REQUEST['id'])) {
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $type = $_POST['type'];

    // Connect to your database (replace with your own database connection code)
    $con = mysqli_connect("localhost", "username", "password", "your_db_name");

    // Validate and sanitize user inputs as needed

    $message = mysqli_real_escape_string($con, $message);
    
    $query = "INSERT INTO chat_messages (sender_id, receiver_id, message_text, type) VALUES ('$uid', '$id', '$message', '$type')";

    if (mysqli_query($con, $query)) {
        // Message sent successfully
    }
    mysqli_close($con);
}

// Fetch chat messages
$messages = array();
if (isset($id)) {
    // Connect to your database (replace with your own database connection code)
    $con = mysqli_connect("localhost", "username", "password", "your_db_name");

    $query = "SELECT sender_id, message_text, type, created_at FROM chat_messages WHERE (sender_id = '$uid' AND receiver_id = '$id') OR (sender_id = '$id' AND receiver_id = '$uid') ORDER BY created_at ASC";
    
    $result = mysqli_query($con, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
    }
    mysqli_close($con);
}

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Add your HTML head content here -->
    <title>Chat with <?php echo $name; ?></title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="background-green"></div>
    <div class="main-container">
        <div class="left-container">
            <!-- Header, notification, search container, and user list as needed -->
        </div>

        <div class="right-container">
            <div class="header">
                <div class="img-text">
                    <div class="user-img">
                        <!-- Add user/seller profile image here -->
                    </div>
                    <h4><?php echo $name; ?><br><span>Online</span></h4>
                </div>
                <div class="nav-icons">
                    <!-- Add navigation icons as needed -->
                </div>
            </div>

            <div class="chat-container">
                <?php foreach ($messages as $message) : ?>
                    <div class="message-box <?php echo ($message['type'] === 'user') ? 'my-message' : 'friend-message'; ?>">
                        <p><?php echo $message['message_text']; ?></p>
                        <span><?php echo $message['created_at']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <form action="" method="post">
                <input type="hidden" name="type" value="<?php echo ($uid === $id) ? 'user' : 'seller'; ?>">
                <div class="chatbox-input">
                    <input type="text" name="message" placeholder="Type a message" required>
                    <button type="submit" name="submit" style="border: none; outline: none; margin-right: 10px;">
                        <!-- Send button icon or image -->
                        
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
