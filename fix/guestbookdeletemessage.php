<?php
include_once("session.php");
include_once("database_config.php");
$session_admin = "session_admin";
$session_username = "session_username";
$session_password = "session_password";
if(isset($_COOKIE[$session_admin])
    || is_admin(unserialize($_COOKIE[$session_username]), unserialize($_COOKIE[$session_password]), $db)) {
    $message= "";
    $file="messages.txt";
    file_put_contents($file, $message);
    $messages=file_get_contents($file);
    echo htmlspecialchars($messages, ENT_NOQUOTES);
};

?>