<?php
declare(strict_types=1);
require 'vendor/autoload.php';
$secret = 'XVQ2UIGO75XRUKJO'; // qr code
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('cloudbox', $secret, 'Cloud-Box-Authenticator');

session_start();

if(isset($_POST['submit'])) {
    $code = $_POST['pass-code'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator(); //grab the authenticator class

    if ($g->checkCode($secret, $code)) { // success if the code is correct
        header("location: loggedin.php");
    } else {
        echo "";
    }


}
?>
<html>
<head>
    <title>Google Authentication</title>
    <script src="http://code.jquery.com/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-well">
         <h1 class="text-center">Google Authenticatior. Please scan the QR Code.</h1>
            <div style="width: 50%; margin: 10px auto;">
                    <center><img src="<?=$link?>"></center><br> <!--change qr code to the image -->
                <p class="text-justify">
                    Please install Google authenticator.
                </p>
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon addon-diff-color">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input type="text" autocomplete="off" class="form-control"
                                   name="pass-code" placeholder="Enter Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="
                            btn btn-warning btn-block" name="submit">
                    </div>
                </form>
            </div>
            </div>
        <div style="position: fixed; bottom: 10px; right: 10px; color: green;">

        </div>
</body>
</html>


























































