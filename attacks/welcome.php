<html>
<body>

<?php
include("database_config.php");

header('Access-Control-Allow-Origin: *');

if (!isset($_COOKIE["session_username"])) {
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
                    setcookie("session_admin", serialize($row['admin']), 2147483647);

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
} else {
    $username = unserialize($_COOKIE["session_username"]);

    echo "<h1>Welcome " . $username . "</h1>";
    
    if (isset($_COOKIE["session_admin"])) {
        echo "<div id=secret><a href=\"secret_service.php\">/!\ Secret Service /!\</a></div></br>";
    }
    
    echo "<div><a href=\"logout.php\">Logout</a></div>";
}
?>

<?php 
$file="messages.txt";
$messages=file_get_contents($file);
?>

<head>
    <script>
    function save(){
        var callback = function () {
            var show=document.getElementById("show");
            show.innerHTML= xmlhttp.responseText;
        };
        var input=document.getElementById("message").value;
        var url = "http://attacks:8080/guestbookleavemessage.php?message="+input;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = callback;
        xmlhttp.send(null);
    }
    </script>
</head>

<body>

<h1>Welcome to our Guest Book, Leave us a Message!</h1>
<input id="message">
<button onclick= 'save()' >Leave a message</button>
<h2>All the messages left by guests </h2>
<div id="show"><?php echo $messages?> </div>

</body>
</html>
