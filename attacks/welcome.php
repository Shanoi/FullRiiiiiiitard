<html>
<body>

<?php
include("database_config.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $result = $db->query("SELECT username, pwd, `admin` FROM users WHERE username='$username'");

    $result->setFetchMode(PDO::FETCH_BOTH);

    $row = $result->fetch();
    
    // Debug only
    //echo print_r($row);
    
    if (!$row) {
        $error = "Your Username is invalid";
    } else {


        if ($row['pwd'] == $pwd) {

            setcookie("session_username", $username, 2147483647);

            echo "<h1>Welcome " . $username . "</h1>";

            if ($row['admin'] == 1) {
                echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            }

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
