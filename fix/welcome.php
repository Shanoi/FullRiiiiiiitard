<html>
<body>

<?php
include("database_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $result = $db->query("SELECT username, pwd, `admin` FROM users WHERE username='$username'");

    $result->setFetchMode(PDO::FETCH_BOTH);

    $row = $result->fetch();
    
    // Debug only
    //echo print_r($row);
    
    if (!$row) {
        echo "<div style=\"color:#cc0000;\">Your Username is invalid</div><br>";
        echo "<a href=\"index.php\">Home</a>";
    } else {
        if ($row['pwd'] == $pwd) {

            setcookie("session_username", serialize($username), 2147483647);

            echo "<h1>Welcome " . $username . "</h1>";

            if ($row['admin'] == 1) {
                echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            }

            echo "<div><a href=\"logout.php\">Logout</a></div>";

        } else {

            echo "<div style=\"color:#cc0000;\">Wrong password</div><br>";
            echo "<a href=\"index.php\">Home</a>";

        }
    }
} else {
    echo "Don't try to fool me! LOGIN!";
    header("Refresh: 2; url=index.php");
}
?>

</body>
</html>
