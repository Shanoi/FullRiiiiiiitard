<html>
<body>

<?php
include("database_config.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $pwd = $_POST["pwd"];

    $result = $db->query("SELECT first_name FROM users WHERE first_name='$first_name'");

    if (!$result->fetch()) {
        $error = "Your First Name is invalid";
    } else {

        $result2 = $db->query("SELECT pwd FROM users WHERE first_name='$first_name'");

        $result2->setFetchMode(PDO::FETCH_BOTH);
        
        $row = $result2->fetch();

        if ($row['pwd'] == $pwd) {

            echo "<h1>Welcome " . $first_name . "</h1>";

        } else {

            echo "Wrong password NOOB<br>";
            echo "<a href=\"index.php\">Home</a>";

        }
    }
}
?>

<!--<h1>Welcome --><?php //echo $first_name; ?><!--</h1>-->

<div style="color:#cc0000;"><?php echo $error; ?></div>

</body>
</html>
