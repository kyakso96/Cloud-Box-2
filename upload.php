<!DOCTYPE html>
<html>
<body>
<?php
    $env: GOOGLE_APPLICATION_CREDENTIALS= "C:\xampp\htdocs\Cloud-Box\credentials\useful-song-309021-9cc4a78dbab2.json";
    # Includes the autoloader for libraries installed with composer
    require __DIR__ . '/vendor/autoload.php';

    # Imports the Google Cloud client library
    use Google\Cloud\Storage\StorageClient;

    # Your Google Cloud Platform project ID
    $projectId = 'useful-song-309021';

    # Instantiates a client
    $storage = new StorageClient([
        'projectId' => $projectId
    ]);

?>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<?php
    include "storage.php";
    $storage = new storage();
print_r($_FILES); exit;
    if (isset($_POST['submit'])) {
        $storage->upload_object('cloud-box-bucket', $_FILES['file']['name'], $_FILES['file']['tmp_name']);
    }
?>
</body>
</html>