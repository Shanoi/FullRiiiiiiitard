<?php

function authenticate($username, $pwd, $db) {
    $result = $db->query("SELECT username, pwd, `admin` FROM users WHERE username='$username'");
    
    $result->setFetchMode(PDO::FETCH_BOTH);
    
    $row = $result->fetch();
    
    // Debug only
    //echo print_r($row);
    
    if (!$row) {
        echo "<div style=\"color:#cc0000;\">Your Username is invalid</div><br>";
        echo "<a href=\"index.php\">Home</a>";
    } else {
        if ($row['admin'] == 1 && $row['pwd'] == hash("sha256", $pwd)) {
            setcookie("session_username", serialize($username), 2147483647);
            setcookie("session_password", serialize($username), 2147483647);
            setcookie("session_admin", serialize($row['admin']), 2147483647);
            
            echo "<h1>Welcome " . $username . "</h1>";
            echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
            echo "<div><a href=\"logout.php\">Logout</a></div>";

            return true;
        } else if ($row['pwd'] == $pwd) {
            setcookie("session_username", serialize($username), 2147483647);
            setcookie("session_password", serialize($pwd), 2147483647);

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

?>
