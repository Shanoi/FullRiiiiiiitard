<?php
   define('DB_SERVER', 'localhost:3307');
   define('DB_USERNAME', 'user');
   define('DB_PASSWORD', 'SAWLeJeudiMatin');
   define('DB_DATABASE', 'saw');
   $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USERNAME, DB_PASSWORD);
?>