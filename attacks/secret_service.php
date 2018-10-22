<?php

$session_admin = "session_admin";
$session_username = "session_username";

if(!isset($_COOKIE[$session_admin])) {
    echo "YOU ARE NOT A SECRET AGENT!";
    header("REFRESH 2; URL = logout.php");
} else {
    $username = unserialize($_COOKIE[$session_username]);
    echo "<h1>Welcome to the secret service agent $username";
    echo "<p>Your secret is 42</p>";
}

?>
