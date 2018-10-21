<?php

$session_cookie = "session_username";

if(!isset($_COOKIE[$session_cookie])) {
    echo "YOU ARE NOT A SECRET AGENT!";
    header("REFRESH 2; URL = logout.php");
} else {
    $username = unserialize($_COOKIE[$session_cookie]);
    echo "<h1>Welcome to the secret service agent $username";
}

?>