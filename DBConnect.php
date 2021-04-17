<?php

/* $inst = getenv('useful-song-309021:europe-west2:cloud-box-sql');
 $user = getenv('root');
 $pass = getenv('pass213');
 $db = getenv('UserDetail');
 $conn = mysqli_connect($inst, $user, $pass, $db); */



$dsn = getenv('CLOUDSQL_DSN');
$user = getenv('CLOUDSQL_USER');
$pass = getenv('CLOUDSQL_PASSWORD');
$dbname = getenv('CLOUDSQL_DB');

try {
    $connect = new PDO($dsn . '; dbname=' . $dbname, $user, $pass);
    $connect->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo 'Database Error:' . $e->getMessage();
}

?>