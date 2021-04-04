<?php
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

class storage {
    private $projectId;
    private $storage;
        public function __construct() {  // main function to connect to our Cloud Project
            putenv("GOOGLE_APPLICATION_CREDENTIALS=C:\\xampp\\htdocs\\Cloud-Box\\credentials\\useful-song-309021-9cc4a78dbab2.json");  // credential to connect to GCP service
            $this->projectId = 'useful-song-309021';  // name of our project id
            $this->storage = new StorageClient([
                'projectId' => $this->projectId
            ]);
        }

     
    function uploadPObject($bucketName, $objectName, $source)  //uploading objects
    {
        $storage = new StorageClient();
        $file = fopen($source, 'r');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName
        ]);
     printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
    }

    function download_object($bucketName, $objectName, $destination) //downloading objects
    {
        $storage = new StorageClient();
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->downloadToFile($destination);
        printf('Downloaded gs://%s/%s to %s' . PHP_EOL,
            $bucketName, $objectName, basename($destination));
    }
    function list_objects($bucketName)
{
    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);
    foreach ($bucket->objects() as $object) {
        printf('Object: %s' . PHP_EOL, $object->name());
    }
}
}