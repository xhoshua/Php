<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//
//// Create connection
//$conn = new mysqli($servername, $username, $password);
//
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
////echo "Connected successfully";


/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=users;host=localhost';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

