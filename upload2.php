<?php

    session_start();
    if (!isset($_SESSION['loggedin'])) //Can't access page unless the user is logged in
    {
        header("Location: index.php");
        die();

    }

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

if(isset($_POST['submit'])!=""){   // Submission function for upload
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];
    $fname = date("YmdHis").'_'.$name;

    $check = $connect->query("SELECT * FROM  upload where name = '$name' ")->rowCount(); //check the file name if it exists
    if($check){
        $i = 1;
        $c = 0;
        while($c == 0){
            $i++;
            $reversedParts = explode('.', strrev($name), 2);
            // new filename
            $tname = (strrev($reversedParts[1]))."_".($i).'.'.(strrev($reversedParts[0]));
            // check function if the file name already exists in the database
            $check_1 = $connect->query("SELECT * FROM  upload where name = '$tname' ")->rowCount();
            if($check_1 == 0){
                $c = 1;
                $name = $tname;
            }
        }
    }
    $move =  move_uploaded_file($temp,"upload/".$fname);
    if($move){
        $query=$connect->query("insert into upload(name,fname)values('$name','$fname')");
        if($query){
            header("location:upload2.php");
        }
        else{
            die(PDO_MySQL());
        }
    }
}

    if(isset($_REQUEST["delete"])) { //the delete function will permanently remove the file from the server and the information from the database

        $id=$_REQUEST['delete']; // get the delete from the name of button and store it in $id variable

        $select_statement= $connect->prepare('SELECT * FROM upload WHERE id =:id'); //sql select query
        $select_statement->bindParam(':id', $id);
        $select_statement->execute();
        $row=$select_statement->fetch(PDO::FETCH_ASSOC);
        unlink("upload/".$row['name']); // remove the selected file from upload

        $delete_statement = $connect->prepare('DELETE FROM upload WHERE id = :id'); // delete original record from the database
        $delete_statement->bindParam(':id', $id);
        $delete_statement->execute();

        header("Location:upload2.php");
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <a href="view-files.php">View Files</a>

        <a href="logout.php">Log Out</a>

    </div>
</div>
<br>
<br><br><br><br><br><br>
<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">Upload</h3>
        </div>
        <div class="panel-body">
            <form action="" name="form" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
                <div class="form-group">
                    <input type="file" name="file" id="file" /></td>

                </div>
                <div class="form-group">
                    <button type="submit"  name="submit" id="submit">Upload </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container" style="opacity: 0.9;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">File List</h3>
        </div>
        <div class="panel-body">
            <!-- list of table where the uploaded files are shown -->
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                <thead>
                <tr>
                    <th width="90%" align="center">Files</th>
                    <th align="center">Download</th>
                    <th align="center">Delete</th>
                </tr>
                </thead>
                <?php
                $query=$connect->query("select * from upload order by id desc");
                while($row=$query->fetch()){
                    $name=$row['name'];
                    ?>
                    <tr>
                        <td>
                            &nbsp;<?php echo $name ;?>
                        </td>
                        <td>
                            <button class="alert-success"><a style="color: black;" href="download.php?filename=<?php echo $name;?>&f=<?php echo $row['fname'] ?>">Download</a></button>
                        </td>
                        <td>
                            <button class="alert-success"><a style="color: black;" href="?delete=<?php echo $row['id'];?>">Delete</a></button>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</div>
</body>
</html>