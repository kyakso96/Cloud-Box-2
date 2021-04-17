
<?php

    session_start();

    if(isset($_GET["register"]))
    {
        if($_GET["register"] == 'success')
        {
            echo '
                <h1 class="text-success"> Email has been verified. Registration has been completed.. </h1> 
            ';
        }
    }

$dsn = getenv('CLOUDSQL_DSN');
$user = getenv('CLOUDSQL_USER');
$pass = getenv('CLOUDSQL_PASSWORD');
$dbname = getenv('CLOUDSQL_DB');

try {
    $connect = new PDO($dsn . '; dbname=' . $dbname, $user, $pass);
    $connect->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo 'Database Error:' . $e->getMessage();
}

    // Define variables and initialize with empty values
    $user_email = $user_password = "";
    $user_email_error = $user_password_error = $login_error = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if username is empty
        if(empty(trim($_POST["email"]))){
            $user_email_error = "Please enter your Email.";
        } else{
            $user_email = trim($_POST["email"]);
        }

        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $user_password_error = "Please enter your password.";
        } else{
            $user_password = trim($_POST["password"]);
        }

        // Validate credentials
        if(empty($user_email_error) && empty($user_password_error)){
            // Prepare a select statement
            $sql = "SELECT user_email, user_password FROM register_user WHERE user_email = :user_email";

            if($statement = $connect->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $statement->bindParam(":user_email", $param_email, PDO::PARAM_STR);

                // Set parameters
                $param_email = trim($_POST["email"]);

                // Attempt to execute the prepared statement
                if($statement->execute()){
                    // Check if username exists, if yes then verify password
                    if($statement->rowCount() == 1){
                        if($row = $statement->fetch()){
                            $user_email = $row["user_email"];
                            $hashed_password = $row["user_password"];
                            if(password_verify($user_password, $hashed_password)){
                                // Password is correct, so start a new session


                                session_start();
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["username"] = $user_email;

                                // Redirect user to the google authenticator
                                header("location: authenticator.php");

                            } else{
                                // Password is not valid displays error message
                                $login_error = "Invalid username or password.";
                            }
                        }
                    } else{
                        // Username doesn't exist displays error message
                        $login_error = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($statement);
            }
        }

        // Close connection
        unset($pdo);
    }
    ?>
<html>
<head>
    <title> Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="navbar">
    <div class="logo">
        CLOUD-BOX
    </div>
    <div class="nav-right">

        <a href="index.php">Home</a>

        <a href="login.php">Sign In</a>

        <a href="register.php">Sign Up</a>

        <a href="#">Why Cloud-Box</a>

    </div>

</div>
<br />
<br><br><br><br><br><br><br><br>
<div style="opacity: 0.9;"  class="container">


    <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">Login</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if(!empty($login_error)){
                        echo '<div class="alert alert-danger">' . $login_error . '</div>';
                    }
                    ?>
                    <form method="POST" id="login_form">
                        <div class="form-group" id="email_area">
                            <label>Enter Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($user_email_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_email; ?>">
                            <span class="invalid-feedback"><?php echo $user_email_error; ?></span>
                        </div>
                        <div class="form-group" id="password_area">
                            <label>Enter password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($user_password_error)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $user_password_error; ?></span>
                        </div>
                        <div class="form-group" align="right">
                            <input type="hidden" name="action" id="action" value="email" />
                            <input type="submit" name="login" id="login" class="btn btn-primary" value="Login" />
                        </div>
                        <p>Don't have an account? <a style="color:black;" href="register.php">Sign up now</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<br />
<br />
</body>
</html>

