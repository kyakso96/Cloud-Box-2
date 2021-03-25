use Google\Cloud\Storage\StorageClient;

function upload_object($bucketName, $objectName, $source)  //uploading objects
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