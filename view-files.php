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
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cloud Computing Application</title>
</head>
<body>
<div class= "navbar">
    <div class="logo">
        CLOUD-BOX
    </div>
    <div class="nav-right">

        <a href="loggedin.php">Home</a>

        <a href="upload2.php">Upload Files</a>

        <a href="logout.php">Log Out</a>

    </div>
</div>
<br><br><br><br><br>
<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">Upload</h3>
        </div>
        <div class="panel-body">
            <form action="view-files.php" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
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

<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">File List</h3>
        </div>
        <div class="panel-body">
            <?php
                $storage = new storage();
                $storage->list_objects('cloud-box-bucket-2');
            ?>
        </div>
        <div class="panel-body">
            <form action="view-files.php" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
                <div class="form-group">
                    <input type="text" name="file">
                </div>
                <div class="form-group">
                    <button type="submit"  name="download">Download </button>
                </div>
            </form>
        </div>
        <?php

        if (isset($_POST['download'])) {
            $storage->download_object('cloud-box-bucket-2', $_FILES['cloud-box-bucket-2']['file'] , "C:\\xampp\\htdocs\\Cloud-Box-2\\Downloads\\DB.txt");
        }
        ?>
    </div>
</div>


</body>
</html>