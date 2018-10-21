<?php
include("database_config.php");

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    $result = $db->query("SELECT first_name, last_name FROM users WHERE first_name='$first_name' AND last_name='$last_name'");

    if(!$result->fetch()) {
        $error = "Your First Name and / or Last Name is invalid";
    } else {
        header("location: welcome.php");
    }
}
?>

<html>
<meta charset="UTF-8">
<body>

<h1>Login</h1>

<form action="" method="POST">
First name: <input type="text" name="first_name" value="Mr"><br>
Last name: <input type="text" name="last_name" value="Robot"><br>
<input type="submit" value="Login">
</form>

<div style = "color:#cc0000;"><?php echo $error; ?></div>

<p>Don't have an account yet? Create one <a href="create_account.html">here</a></p>

</body>
</html>
