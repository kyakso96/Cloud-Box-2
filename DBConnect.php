<?php

/* $inst = getenv('useful-song-309021:europe-west2:cloud-box-sql');
 $user = getenv('root');
 $pass = getenv('pass213');
 $db = getenv('UserDetail');
 $conn = mysqli_connect($inst, $user, $pass, $db); */


/*
$servername = "localhost";
$username = "root";
$password = "pass213";

try {
        $connect = new PDO("mysql:host=$servername;port=3307;dbname=userdetail", $username, $password);
        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
} catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
}
*/
$user = getenv('CLOUDSQL_USER');
$password = getenv('CLOUDSQL_PASSWORD');
$dsn = getenv('CLOUDSQL_DSN');
#$db = getenv('CLOUDSQL_DB');
$connect = new PDO(null, $user, $password, null, $dsn);