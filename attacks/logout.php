<?php

$session_username = "session_username";
unset($_COOKIE[$session_username]);
setcookie($session_username, '', time() - 3600);

$session_admin = "session_username";
unset($_COOKIE[$session_admin]);
setcookie($session_admin, '', time() - 3600);

header("location: index.php");

?>
