<?php
include("database_config.php");

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["pwd"];

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insert_new_user = "INSERT INTO users (username, pwd) VALUES ('$username', '$password')";
    $result = $db->exec($insert_new_user);
    if ($result === false) {
        $error = "Your username and / or password is invalid";
    } else {
        header("location: index.php");
    }
}
?>

<html>
<meta charset="UTF-8">
<body>

<h1>Create an account</h1>

<form action="" method="POST">
Username: <input type="text" name="username" value=""><br>
Password: <input type="password" name="pwd" value=""><br>
<input type="submit" value="Create account">
</form>

<div style = "color:#cc0000;"><?php echo $error; ?></div>

<p>Already have an account? Login <a href="index.php">here</a></p>

</body>
</html>
