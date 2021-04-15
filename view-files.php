<?php
session_start();
if (!isset($_SESSION['loggedin'])) //Can't access page unless the user is logged in
{
    header("Location: index.php");
    die();

}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/Website.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery.js"></script>
    <title>Cloud Computing Application</title>
</head>
<body>
<header>
    <div class="logo">
        CLOUD-BOX
    </div>
    <nav>
        <ul>
            <li>
                <a href="loggedin.php">Home</a>
            </li>
            <li>
                <a href="upload.php">Upload Files</a>
            </li>

            <li>
                <a href="logout.php">Log Out</a>
        </ul>
    </nav>

</header>
<br>
<br>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">File List</h3>
        </div>
        <div class="panel-body">
            <?php
                include "storage.php";
                $storage = new storage();

                $storage->list_objects('cloud-box-bucket-2');

            ?>
        </div>
    </div>
</div>


</body>
</html>