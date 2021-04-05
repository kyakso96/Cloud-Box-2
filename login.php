<<<<<<< Updated upstream
=======
<?php
   include("DBConnect.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $pass = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM Register WHERE email = '$email' and pass = '$pass'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("email");
         $_SESSION['login_user'] = $email;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
>>>>>>> Stashed changes
<html>
<head>
      <title> User login and Registration </title>
      <link rel="stylesheet" type="text/css"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

<div class="container">
      <div class="login-box">
      <div class="row">
      <div class="col-md-6">
            <h2> Login here </h2)
            <form action="validation.php" method="post">
                  <div class="form-gorup">
                        <label>username</label>
                        <input type="text" name="user" class="form-control" required>
                        </div>
                  <div class="form-group">
                        <label> password</label>
                        <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> Login </button>
                  </form>
            </div>
            <div class="col-md-6">
            <h2> Register here </h2)
            <form action="registration.php" method="post">
                  <div class="form-gorup">
                        <label>username</label>
                        <input type="text" name="user" class="form-control" required>
                        </div>
                  <div class="form-group">
                        <label> password</label>
                        <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> Register </button>
                  </form>
            </div>

            </div>
            
   </body>
   </html>