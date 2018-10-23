<?php
$message= "a";
$file="messages.txt";
file_put_contents($file, $message);
$messages=file_get_contents($file);
echo $messages;
?>
