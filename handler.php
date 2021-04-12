<?php

switch ($_SERVER['REQUEST_URI']) {
    case '/':
        include 'index.php';
        break;
    case '/index.php':
        include 'index.php';
        break;
    case '/login.php':
        include 'login.php';
        break;
    case '/register.php':
        include 'register.php';
        break;
    case '/email_verify.php':
        include 'email_verify.php';
        break;
    case '/logout.php':
        include 'logout.php';
        break;
    case '/upload.php':
        include 'upload.php';
        break;
    default:
        include 'index.php';
        break;





}








?>
