<?php
include_once("session.php");
include_once("database_config.php");
header("Cache-Control: no-store, must-revalidate");
header('Access-Control-Allow-Origin: *');

if (!isset($_COOKIE["session_username"]) && !isset($_COOKIE["session_password"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];

        if (authenticate($username, $pwd, $db)) {
            require("guestbook.php");
            require("library.php");
        }
    } else {
        echo "Don't try to fool me! LOGIN!";
        header("Refresh: 2; url=index.php");
    }
} else {
    $username = unserialize($_COOKIE["session_username"]);
    $pwd = unserialize($_COOKIE["session_password"]);

    if (authenticate_cookies($username, $pwd, $db)) {
        require("guestbook.php");
        require("library.php");
    }
}
?>


</body>
</html>