<?php
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;


class storage {
    private $projectId;
    private $storage;
        public function __construct() {  // main function to connect to our Cloud Project
            putenv("GOOGLE_APPLICATION_CREDENTIALS=C:\\xampp\\htdocs\\Cloud-Box-2\\credentials\\bustling-walker-308215-f4f9c37eaabf.json");  // credential to connect to GCP service
            $this->projectId = 'bustling-walker-308215';  // name of our project id
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
    function list_objects($bucketName)  //list function inside our cloud bucket
{
    $storage = new StorageClient();
    $bucket = $storage->bucket($bucketName);
    foreach ($bucket->objects() as $object) {
        printf("<table> 
                <tr>
                    <th>File name</th>
                    <th>Link</th>
                </tr>                
                <tr>
                    <td><a style='color: black;' href='' name='download'>%s</a></td>
                    <td>Download</td>
                </tr> 
                </table>" .  '<br>' . '<br>' . PHP_EOL, $object->name());
    }
}
    function list_objects_download($bucketName, $objectName, $destination)
    {
        $storage = new StorageClient();
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->downloadToFile($destination);
        foreach ($bucket->objects() as $object) {
            printf("<table> 
                <tr>
                    <th>File name</th>
                    <th>Link</th>
                </tr>                
                <tr>
                    <td><a href='#' name='download'>%s</a></td>
                    <td>Download</td>
                </tr> 
                </table>" .  '<br>' . '<br>' . PHP_EOL, $object->name(), $objectName, basename($destination));
        }
    }


}