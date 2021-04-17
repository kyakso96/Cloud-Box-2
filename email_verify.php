<?php

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

    $error_user_otp = '';
    $user_activation_code = '';
    $message = '';

    if(isset($_GET["code"]))
    {
        $user_activation_code = $_GET["code"];  // store get code value in local variable user activation code

        if(isset($_POST["submit"]))
        {
            if(empty($_POST["user_otp"])) // if field is empty
            {
                $error_user_otp = 'Enter OTP Code';
            }
            else
            {
                $query = "    
                SELECT * FROM register_user -- this query will search data and register in user table
                WHERE user_activation_code =  '".$user_activation_code."'
                AND user_otp = '".trim($_POST["user_otp"])."'
                ";

                $statement = $connect->prepare($query); //this will make query for execution

                $statement->execute(); // this method will execute all query

                $total_row = $statement->rowCount(); // this will return number of affected row

                if($total_row > 0)
                {
                    $query = "
                    UPDATE register_user  -- this query will update the user email status if the otp code is correct
                    SET user_status = 'verified'
                    WHERE user_activation_code = '".$user_activation_code."'
                    " ;

                    $statement = $connect->prepare($query);

                    if($statement->execute()) // if the query will successfully run then run the statement
                    {
                           header('location:login.php?register=success') ;
                    }
                }
                else
                {
                    $message = '<label class="text-danger">Invalid OTP Code</label>' ;
                }
            }
        }
    }
    else {

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
                    <h3 class="panel-title">Enter OTP Code</h3>
                </div>
                <div class="panel-body">
                    <?php
                        echo $message;
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Enter OTP Code</label>
                            <input type="text" name="user_otp" class="form-control" />
                            <?php
                                echo $error_user_otp;
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

   </body>
</html>
