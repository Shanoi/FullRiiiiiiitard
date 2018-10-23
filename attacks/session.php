<?php

function authenticate_cookies($username, $pwd, $db)
{
    $result = $db->query("SELECT username, pwd, `admin` FROM users WHERE username='$username'");

    $result->setFetchMode(PDO::FETCH_BOTH);

    $row = $result->fetch();

    // Debug only
    //echo print_r($row);

    if (!$row) {
        echo "<div style=\"color:#cc0000;\">Your Username is invalid</div><br>";
        echo "<a href=\"index.php\">Home</a>";
    } else {
        if ($row['admin'] == 1 && $row['pwd'] == $pwd) {
            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;

        } else if (($pwd == $row['pwd'])||($row['pwd'] == unserialize($pwd))) {
            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;
        } else {
            echo $pwd;
            echo $row['pwd'];
            echo unserialize($pwd);
            echo "<div style=\"color:#cc0000;\">Wrong password</div><br>";
            echo "<a href=\"index.php\">Home</a>";

            return false;
        }
    }

    return false;
}

function authenticate($username, $pwd, $db)
{
    $result = $db->query("SELECT username, pwd, `admin` FROM users WHERE username='$username'");

    $result->setFetchMode(PDO::FETCH_BOTH);

    $row = $result->fetch();

    // Debug only
    //echo print_r($row);

    if (!$row) {
        echo "<div style=\"color:#cc0000;\">Your Username is invalid</div><br>";
        echo "<a href=\"index.php\">Home</a>";
    } else {
        if ($row['admin'] == 1 && $row['pwd'] == strtoupper(hash("sha256", $pwd))) {
            setcookie("session_username", serialize($username), 2147483647);
            setcookie("session_password", serialize(strtoupper(hash("sha256", $pwd))), 2147483647);
            setcookie("session_admin", serialize($row['admin']), 2147483647);

            $_COOKIE["session_username"] = serialize($username);
            $_COOKIE["session_password"] = serialize(strtoupper(hash("sha256", $pwd)));
            $_COOKIE["session_admin"] = serialize($row['admin']);

            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;
        } else if ($row['pwd'] == $pwd) {
            setcookie("session_username", serialize($username), 2147483647);
            setcookie("session_password", serialize($pwd), 2147483647);

            $_COOKIE["session_username"] = serialize($username);
            $_COOKIE["session_password"] = serialize(strtoupper(hash("sha256", $pwd)));

            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;
        } else {
            echo "<div style=\"color:#cc0000;\">Wrong password</div><br>";
            echo "<a href=\"index.php\">Home</a>";

            return false;
        }
    }

    return false;
}

function is_admin($username, $pwd, $db)
{
    //echo $username;
    //echo $pwd;
    $stmt = $db->prepare("SELECT username, pwd, `admin` FROM users WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    return $row['admin'] == 1;
}

?>
