<?php

//Connect to ccuresearch
$dsn= "mysql:host=localhost;dbname=495fire";
$user = "495fire";
$pass = "I love Chants";
$pdo = new PDO($dsn,$user,$pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>