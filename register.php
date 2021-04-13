<?php

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

$user = getenv('CLOUDSQL_USER');
$password = getenv('CLOUDSQL_PASSWORD');
$dsn = getenv('CLOUDSQL_DSN');
#$db = getenv('CLOUDSQL_DB');
$connect = new PDO(null, $user, $password, null, $dsn);

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

    if($error_user_name == '' && $error_user_email == '' && $error_user_password == '')
    {

        $data = array(
            ':user_name'            =>  $user_name,
            ':user_email'           =>  $user_email,
            ':user_password'        =>  $user_password,
        );

        $query = "
                INSERT INTO register_user_1
                (user_name, user_email, user_password)
                SELECT * FROM (SELECT :user_name, :user_email, :user_password) AS tmp
                WHERE NOT EXISTS ( -- query will execute only if user email does not exist in register user table
                    SELECT user_email FROM register_user_1 WHERE user_email = :user_email   
                ) LIMIT 1
            ";

        $statement = $connect->prepare($query); // this will make query for execution

        $statement->execute($data);

        if($connect->lastInsertId() == 0)
        {
            $message = '<label class="text-danger">Email Already Register</label>';
        }
        else {  // registration via phpmailer using auto gmail account.
            $message = '<label class="text-danger">Register Success.</label>';
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
</head>
<body>
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