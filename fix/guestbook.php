<?php
include_once("session.php");
include_once("database_config.php");
header("Content-Security-Policy: script-src 'self'");

$file = "messages.txt";
$messages = file_get_contents($file);
?>
<script src="boot.js"></script>
<body>

<h1>Welcome to our Guest Book, Leave us a Message!</h1>
<input id="message">
<button id="save">Leave a message</button>


<h2>All the messages left by guests</h2>
<div id="show"><?php echo htmlspecialchars($messages, ENT_NOQUOTES) ?></div>
<?php
$session_admin = "session_admin";
$session_username = "session_username";
$session_password = "session_password";
if (isset($_COOKIE[$session_admin]) || is_admin(unserialize($_COOKIE[$session_username]), unserialize($_COOKIE[$session_password]), $db)) {
    require("clear_message.php");
}
?>
<script src="guestbook.js"></script>

</body>
</html>
