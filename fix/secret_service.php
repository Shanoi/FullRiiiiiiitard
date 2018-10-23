<?php
include_once("session.php");
include_once("database_config.php");

$session_admin = "session_admin";
$session_username = "session_username";
$session_password = "session_password";

if(!isset($_COOKIE[$session_admin]) || !is_admin(unserialize($_COOKIE[$session_username]), unserialize($_COOKIE[$session_password]), $db)) {
    echo "YOU ARE NOT A SECRET AGENT!";
    header("Refresh: 2; url=logout.php");
} else {
    $username = unserialize($_COOKIE[$session_username]);
    echo "<h1>Welcome to the secret service agent $username";
    echo "<p>Your secret is 42</p>";
}

?>
