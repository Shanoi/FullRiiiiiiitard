<?php
include_once("session.php");
include_once("database_config.php");
$file = "messages.txt";
$messages = file_get_contents($file);



?>


<script>
    function save() {
        var callback = function () {
            var show = document.getElementById("show");
            show.innerHTML = xmlhttp.responseText;
        };
        var input = document.getElementById("message").value;
        var url = "http://attacks/guestbookleavemessage.php?message=" + input;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', url, true);
        xmlhttp.onreadystatechange = callback;
        xmlhttp.send(null);
    }
</script>


<h1>Welcome to our Guest Book, Leave us a Message!</h1>
<input id="message">
<button onclick='save()'>Leave a message</button>
<?php
$session_admin = "session_admin";
$session_username = "session_username";
$session_password = "session_password";
if(isset($_COOKIE[$session_admin]) || is_admin(unserialize($_COOKIE[$session_username]), unserialize($_COOKIE[$session_password]), $db)) {
    require("clear_message.php");
}
?>
<h2>All the messages left by guests </h2>
<div id="show"><?php echo $messages ?> </div>


