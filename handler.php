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
    case '/authenticator.php':
        include 'authenticator.php';
        break;
    case '/storage.php':
        include 'storage.php';
        break;
    case '/login.php?register=success':
        include 'login.php?register=success';
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
    case '/loggedin.php':
        include 'loggedin.php';
        break;
    case '/upload2.php':
        include 'upload2.php';
        break;
    case '/view-files.php':
        include 'view-files.php';
        break;
    default:
        include 'error.php';
        break;

}








?>
