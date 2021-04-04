<!DOCTYPE html>
<html>
<body>


    <form action="upload.php" method="post" enctype="multipart/form-data"> <!-- form to upload files into the biucket -->
        <input type="file" name="file">
        <button type="submit"  name="upload">Upload </button>
    </form>

    <?php
        include "storage.php";  // call upload object from storage.php to push file into the cloud storage
        $storage = new storage();  
   //print_r($_FILES); exit; // only to check if it is connecting
        if (isset($_POST['upload'])) { //call upload from the submit form to push the object
            $storage->uploadPObject('cloud-box-bucket', $_FILES['file']['name'], $_FILES['file']['tmp_name']);
        }
    ?>

</body>
</html>