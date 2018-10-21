<?php

$session_cookie = "session_username";
unset($_COOKIE[$session_cookie]);
setcookie($session_cookie, '', time() - 3600);
header("location: index.php");

?>