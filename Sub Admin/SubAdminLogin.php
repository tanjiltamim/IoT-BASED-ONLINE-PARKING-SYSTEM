<?php 
  require("../connect.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../login_register.css" />
    <!-- Fontawesome CDN Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <nav id="navBar">
        <a href="../index.html"><img src="../images/logo.png" class="logo" /></a>
      </nav>
      <input type="checkbox" id="flip" />
      <div class="cover">
        <div class="front">
          <img src="../images/SubAdminLogin.jpg" alt="" />
        </div>
      </div>
      <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
            <form method="POST">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="text" name="email" placeholder="Enter your email" required />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password" name="password"
                    placeholder="Enter your password"
                    required
                  />
                </div>
                <div class="text"><a href="#">Forgot password?</a></div>
                <div class="button input-box">
                  <input
                    type="submit"
                    value="Login"
                    name="login"
                    class="login"
                  />
                </div>
                <div class="text sign-up-text">
                  Don't have an account?
                  <a href="SubAdminRegister.php">Register now</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<?php

if(isset($_POST['login']))
{
  $query="SELECT * FROM `subadmin_list` WHERE email='$_POST[email]' AND password='$_POST[password]'";
  $result=mysqli_query($con,$query);
  if (mysqli_num_rows($result)==1)
  {
    session_start();
    $_SESSION['SubAdminLoginEmail']=$_POST['email'];
    header("location:SubAdmin.php");
  }
  else {
    echo "<script>alert('Incorrect Email or Password!') </script>";
  }
}

?>