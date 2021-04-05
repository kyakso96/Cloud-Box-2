<?php
include "DBConnect.php";
session_start();

$dsn = "/cloudsql/useful-song-309021:europe-west2:cloud-box-sql;dbname=UserDetail";
$user = "root";
$pass = "pass213";
$conn = mysqli_connect($dsn, $user, $pass);

    $name = $_POST['user'];
    $pass = $_POST['pass'];

    $s = "select * from Register where name = '$name'";

    $result = mysqli_query($conn, $s);

    $num = mysqli_num_rows($result);

    if($num == 1){
        echo"username already taken";
    } else {
        $reg = "insert into Register(name, pass) values ('$name', '$pass')";
        mysqli_query($conn,$reg);
        echo "Registration Successful!";
    }

?>