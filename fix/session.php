<?php

function is_admin($username, $pwd, $db)
{
    $stmt = $db->prepare("SELECT username, pwd, `admin` FROM users WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    return $row['admin'] == 1;
}

function authenticate_cookies($username, $pwd, $db)
{
    $stmt = $db->prepare("SELECT username, pwd, `admin` FROM users WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

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
        } else if ($row['pwd'] == $pwd) {
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

function authenticate($username, $pwd, $db)
{
    $stmt = $db->prepare("SELECT username, pwd, `admin` FROM users WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    // Debug only
    //echo print_r($row);

    if (!$row) {
        echo "<div style=\"color:#cc0000;\">Your Username is invalid</div><br>";
        echo "<a href=\"index.php\">Home</a>";
    } else {
        $pwd = strtoupper(hash("sha256", $pwd));
        if ($row['admin'] == 1 && $row['pwd'] == $pwd) {
            setcookie("session_username", serialize($username), 2147483647, '/', null, null, true);
            setcookie("session_password", serialize($pwd), 2147483647, '/', null, null, true);
            setcookie("session_admin", serialize($row['admin']), 2147483647, '/', null, null, true);

            $_COOKIE["session_username"] = serialize($username);
            $_COOKIE["session_password"] = serialize(strtoupper(hash("sha256", $pwd)));
            $_COOKIE["session_admin"] = serialize($row['admin']);

            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;
        } else if ($row['pwd'] == $pwd) {
            setcookie("session_username", serialize($username), 2147483647, '/', null, null, true);
            setcookie("session_password", serialize($pwd), 2147483647, '/', null, null, true);

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

function tooMuchAttempt($username, $db)
{
    $stmt = $db->prepare("SELECT attempt FROM loginattempt WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    return $row['attempt'] >= 3;
}

function reinitializeAttempt($username, $db)
{

    $stmt = $db->prepare("SELECT attempt FROM loginattempt WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    if ($row) {

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $reinitialize = $db->prepare("UPDATE loginattempt SET `attempt` = :att WHERE `username`=:usr");
        $result = $reinitialize->execute([
            ':usr' => $username,
            ':att' => 0
        ]);
    }
}

function logging($username, $db)
{

    $stmt = $db->prepare("SELECT attempt FROM loginattempt WHERE username=:usr");
    $stmt->bindParam(':usr', $username);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);

    $row = $stmt->fetch();

    if (!$row) {

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insert_new_user = $db->prepare("INSERT INTO loginattempt (username, attempt) VALUES (:usr, :att)");
        $result = $insert_new_user->execute([
            ':usr' => $username,
            ':att' => 0
        ]);
    } else {

        $attempts = $row['attempt'] + 1;

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $update_user = $db->prepare("UPDATE loginattempt SET `attempt` = :att WHERE `username`=:usr");
        $result = $update_user->execute([
            ':usr' => $username,
            ':att' => $attempts
        ]);

    }
}

?>
