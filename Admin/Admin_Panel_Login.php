<?php 
  require("../connect.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="Admin_Panel_Login.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Admin Login</span></div>
        <form method="POST">
          <div class="row">
            <i class="fas fa-user"></i>
            <input
              type="text"
              name="Admin_Name"
              placeholder="Admin Name"
              required
            />
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input
              type="password"
              name="Admin_Password"
              placeholder="Password"
              required
            />
          </div>
          <div class="row button">
            <input type="submit" name="login" value="Login" />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

if(isset($_POST['login']))
{
  $query="SELECT * FROM `admin_login` WHERE AdminName='$_POST[Admin_Name]' AND AdminPassword='$_POST[Admin_Password]'";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)==1)
  {
    session_start();
    $_SESSION['AdminLoginName']=$_POST['Admin_Name'];
    header("location:Admin_Panel.php");
  }
  else {
    echo "<script>alert('Incorrect Admin Name or Password!') </script>";
  }
}

?>