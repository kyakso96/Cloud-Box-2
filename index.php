<?php

include 'main.php';

?>

<?php
    putenv( setting: "GOOGLE_APPLICATION_CREDENTIALS=C:\\xampp\\htdocs\\web_cloud_storage\\Cloud-Box\\credentials\\useful-song-309021-be6c5ddcef2e.json") ;
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