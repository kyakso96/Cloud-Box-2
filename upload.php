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
                <a href="view-files.php">View Files</a>
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
        <h3 class="panel-title" align="center">Upload</h3>
    </div>
    <div class="panel-body">
    <form action="upload.php" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
        <div class="form-group">
        <input type="file" name="file">
        </div>
        <div class="form-group">
        <button type="submit"  name="upload">Upload </button>
        </div>
    </form>
    </div>
</div>
</div>
    <?php
        include "storage.php";  // call upload object from storage.php to push file into the cloud storage
        $storage = new storage();  
   //print_r($_FILES); exit; // only to check if it is connecting
        if (isset($_POST['upload'])) { //call upload from the submit form to push the object
            $storage->uploadPObject('cloud-box-bucket-2', $_FILES['file']['name'], $_FILES['file']['tmp_name']);
        }
    ?>

</body>
</html>