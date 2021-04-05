<?php
session_start();
include "DBConnect.php";

$dsn = "/cloudsql/useful-song-309021:europe-west2:cloud-box-sql;dbname=UserDetail";
$user = "root";
$pass = "pass213";
$conn = mysqli_connect($dsn, $user, $pass);

    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $s = "select * from Register where name = '$name' && pass = '$pass'";

    $result = mysqli_query($conn, $s);

    $num = mysqli_num_rows($result);

    if($num == 1){
        header('location:index.php');
    } else {
        header('location:login.php');
}

?>