<html>
<body>

<?php
include("database_config.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $result = $db->query("SELECT username, pwd FROM users WHERE username='$username'");

    $result->setFetchMode(PDO::FETCH_BOTH);

    $row = $result->fetch();

    if (!$row) {
        $error = "Your Username is invalid";
    } else {


        if ($row['pwd'] == $pwd) {

            setcookie("session_username", $username, 2147483647);

            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

        } else {

            echo "Wrong password<br>";
            echo "<a href=\"index.php\">Home</a>";

        }
    }
}
?>

<!--<h1>Welcome --><?php //echo $username; ?><!--</h1>-->

<div style="color:#cc0000;"><?php echo $error; ?></div>

</body>
</html>
