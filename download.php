<?php
function file_output($file, $name, $mime_type='')

    // This function takes a path to a file to output ($file), the filename that the browser will see ($name) and the MIME type of the file ($mime_type, optional).
{
    if(!is_readable($file)) die('File not found!'); // if the file is not found the kill the session

    $size = filesize($file);  // read the size of the file
    $name = rawurldecode($name); //Returns a string in which the sequences with percent signs followed by two hex digits
    $known_mime_types=array(
        "pdf" => "application/pdf",
        "txt" => "text/plain",
        "html" => "text/html",
        "htm" => "text/html",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "png" => "image/png",
        "jpeg"=> "image/jpg",
        "jpg" => "image/jpg",
        "php" => "text/plain"
    );

    if($mime_type==''){
        $file_extension = strtolower(substr(strrchr($file,"."),1)); // changes string to lower case
        if(array_key_exists($file_extension, $known_mime_types)){
            $mime_type=$known_mime_types[$file_extension];
        } else {
            $mime_type="application/force-download";
        };
    };

    @ob_end_clean(); //turn off output buffering to decrease cpu usage


    if(ini_get('zlib.output_compression')) // required for IE, otherwise Content-Disposition may be ignored
        ini_set('zlib.output_compression', 'Off');
    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="'.$name.'"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');
    header("Cache-control: private"); //make the download non-cacheable
    header('Pragma: private');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    if(isset($_SERVER['HTTP_RANGE'])) // for multipart-download and download being able to resume
    {
        list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
        list($range) = explode(",",$range,2);
        list($range, $range_end) = explode("-", $range);
        $range=intval($range);
        if(!$range_end) {
            $range_end=$size-1;
        } else {
            $range_end=intval($range_end);
        }
        $new_length = $range_end-$range+1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length=$size;
        header("Content-Length: ".$size);
    }
    $chunksize = 1*(1024*1024); // output the file
    $bytes_send = 0;

    if ($file = fopen($file, 'r'))
    {
        if(isset($_SERVER['HTTP_RANGE']))
            fseek($file, $range); //This function moves the file pointer from its current position to a new position specified by the number of bytes.

        while(!feof($file) && //checks if the end-of-file has been reached for an open file.
            (!connection_aborted()) &&
            ($bytes_send<$new_length)
        )
        {
            $buffer = fread($file, $chunksize);
            print($buffer);
            flush();
            $bytes_send += strlen($buffer);
        }
        fclose($file);
    } else

        die('Error - cannot open file.');
    die();
}
set_time_limit(0);
$file_path='upload/'.$_REQUEST['f']; //uploaded in the upload folder as well
file_output($file_path, ''.$_REQUEST['filename'].'', 'text/plain');

?>