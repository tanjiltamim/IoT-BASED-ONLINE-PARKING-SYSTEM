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
          <div class="signup-form">
            <div class="title">Register</div>
            <form action="insert_subAdmin.php" method="POST">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-user"></i>
                  <input
                    type="text"
                    name="name"
                    placeholder="Enter your name"
                    required
                  />
                </div>

                <div class="input-box">
                  <i class="fas fa-phone"></i>
                  <input
                    type="number"
                    name="phone"
                    placeholder="Enter your phone number"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                  />
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                  />
                </div>
                <div class="button input-box">
                  <input
                    type="submit"
                    name="submit"
                    class="submit"
                    value="Submit"
                  />
                </div>

                <div class="text sign-up-text">
                  Already have an account?
                  <a href="SubAdminLogin.php">Login now</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
