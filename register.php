<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*$dsn = getenv('CLOUDSQL_DSN');
$user = getenv('CLOUDSQL_USER');
$password = getenv('CLOUDSQL_PASSWORD');

try {
    $connect = new PDO($dsn, $user, $passwprd);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}*/
/*$username = 'root';
$password = 'pass213';
$dbName = 'userdetail';
$dbHost = "localhost";

// Connect using TCP
$dsn = sprintf('mysql:dbname=%s;host=%s', $dbName, $dbHost);

// Connect to the database
$connect = new PDO($dsn, $username, $password, $connConfig); */

$servername = "localhost";
$username = "root";
$password = "pass213";

try {
    $connect = new PDO("mysql:host=$servername;port=3307;dbname=userdetail", $username, $password);
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// defined variables
$message = '';
$error_user_name = '';
$error_user_email = '';
$error_user_password = '';
$user_name = '';
$user_email = '';
$user_password = '';

if(isset($_POST["register"]))  // if register is set then executes the code
{
    if(empty($_POST["user_name"]))
    {
        $error_user_name = "<label class='text-danger'>Name is required*</label>";
    }
    else {
        $user_name = trim($_POST["user_name"]); // function will remove spaces from left and right
        $user_name = htmlentities($user_name); // convert special variable into html entity
    }

    if(empty($_POST["user_email"]))
    {
        $error_user_email = "<label class='text-danger'>Email is required*</label>";
    }
    else {
        $user_email = trim($_POST["user_email"]);
        if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) // 2 filter parameter to check email
        {
            $error_user_email = "<label class='text-danger'>Enter Valid Email</label>"; // executes if user enters email in wrong format
        }
    }

    if(empty($_POST["user_password"]))
    {
        $error_user_password = "<label class='text-danger'>Password is required*</label>";
    }
    else {
        $user_password = trim($_POST["user_password"]);
        $user_password = password_hash($user_password, PASSWORD_DEFAULT); // convert simple text into hashed format
    }

    if($error_user_name == '' && $error_user_email == '' && $error_user_password == '') {
        $user_activation_code = md5(rand()); // this will generate dynamic code


        $user_otp = rand(100000, 999999); // generate number between the range

        $data = array(
            ':user_name' => $user_name,
            ':user_email' => $user_email,
            ':user_password' => $user_password,
            ':user_activation_code' => $user_activation_code,
            ':user_status' => 'not verified',
            ':user_otp' => $user_otp
        );

        $query = "
                    INSERT INTO register_user
                    (user_name, user_email, user_password, user_activation_code, user_status, user_otp)
                    SELECT * FROM (SELECT :user_name, :user_email, :user_password, :user_activation_code, :user_status, :user_otp) AS tmp
                    WHERE NOT EXISTS ( -- query will execute only if user email does not exist in register user table
                        SELECT user_email FROM register_user WHERE user_email = :user_email   
                    ) LIMIT 1
                ";

        $statement = $connect->prepare($query); // this will make query for execution

        $statement->execute($data);

        if ($connect->lastInsertId() == 0) {
            $message = '<label class="text-danger">Email Already Register</label>';
        } else {  // registration via phpmailer using auto gmail account.
            require 'vendor/autoload.php';
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '587';
            $mail->SMTPAuth = true;
            $mail->Username = 'kyakso96@gmail.com';
            $mail->Password = 'xpletlcxycumdaef';
            $mail->SMTPSecure = 'tls';
            $mail->From = 'kyakso96@gmail.com';
            $mail->FromName = "Cloud-Box";
            $mail->AddAddress($user_email);
            $mail->IsHTML(true);
            $mail->Subject = 'Verification code for email address';

            $message_body = '<p> To verify your email address, enter this verification code when prompted: 
                                <b>' . $user_otp . '</b>.</p> <p>Sincerely,</p><p>Cloud-box.info</p>';

            $mail->Body = $message_body;

            if ($mail->Send()) {
                echo '<script>alert("PLease Check email for code.")</script>';
                header('location:email_verify.php?code=' . $user_activation_code);
            } else {
                $message = $mail->ErrorInfo;
            }
        }
    }
    }
?>

<html>
<head>
    <title> Register </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Website.css">
</head>
<body>
<header>
    <div class="logo">
        CLOUD-BOX
    </div>
    <nav>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="login.php">Sign In</a>
            </li>
            <li>
                <a href="register.php">Sign Up</a>
            </li>
            <li>
                <a href="#">Why Cloud-Box</a>
            </li>
        </ul>
    </nav>

</header>
<br />
<div class="container">
    <h3 align="center">Register</h3>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registration</h3>
        </div>
        <div class="panel-body">
            <?php
            echo $message;
            ?>
            <form method="post">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="user_name" class="form-control" />
                    <?php
                    echo $error_user_name;
                    ?>
                </div>
                <div class="form-group">
                    <label>Your Email</label>
                    <input type="email" name="user_email" class="form-control" />
                    <?php
                    echo $error_user_email;
                    ?>
                </div>
                <div class="form-group">
                    <label>Your Password</label>
                    <input type="password" name="user_password" class="form-control" />
                    <?php
                    echo $error_user_password;
                    ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="register" class="btn btn-success" value="register" />
                </div>
                <p>Already have an account? <a href="login.php">Login now</a>.</p>
            </form>
        </div>
    </div>
</div>

</body>
</html>