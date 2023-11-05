<?php
  session_start();
  if(!isset($_SESSION['AdminLoginName']))
  {
    header("location:Admin_Panel_Login.php");
  }
  include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="Admin_Panel.css" />

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
  </head>
  <body>
    <nav>
      <a class="AdminHome"href="Admin_Panel.php">
        <div class="logo-name" >
          <div class="logo-image">
            <img src="images/logo_dark.png"/>
          </div>
          <span class="logo_name" >ParkOnline</span>
        </div>
      </a>
      

      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="Admin_Panel.php">
              <i class="uil uil-estate"></i>
              <span class="link-name">Dahsboard</span>
            </a>
          </li>
          <li>
            <a href="view_SubAdminList.php">
              <i class="uil uil-map-marker-info"></i>
              <span class="link-name">Sub-Admin List</span>
            </a>
          </li>
          <li>
            <a href="view_UserList.php">
              <i class="uil uil-users-alt"></i>
              <span class="link-name">User List</span>
            </a>
          </li>
        </ul>

        <ul class="logout-mode">
          <li>
          <form method="POST">
              <button name="logout" class="log-out">
                <i class="uil uil-signout"></i>LOG OUT
              </button>     
          </form> 
          </li>
        </ul>

      </div>
    </nav>

    <section class="dashboard">
      <div class="top">
        <form action="" method="" class="search-box">
          <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" name="search-text" placeholder="Search here by ID or Email" required/>
            <button type="submit" class="search" name="search-btn">Search</button>
          </div>
        </form>
          
        <div>
          <span class="admin_name"><?php echo $_SESSION['AdminLoginName']?></span>
          <img src="images/profile.png" alt="" />
        </div>
        
      </div>

      <div class="dash-content">
        <div class="overview">
            <a href="Admin_Panel.php">
              <div class="title">
                <i class="uil uil-map-marker-info"></i>
                <span class="text">Dahsboard</span>
              </div>
            </a>
          <div class="boxes">

            <div class="box box1">
              <i class="uil uil-map-marker-info"></i>
              <span class="text">Total Sub-Admin</span>

              <?php
                $sql="SELECT * FROM `subadmin_list`";
                $result=mysqli_query($con,$sql);
                $row = mysqli_num_rows($result);
              ?>
              <span class="number"><?php echo ''.$row.''?></span>
            </div>

            <div class="box box2">
              <i class="uil uil-users-alt"></i>
              <span class="text">Total User</span>
              <?php
                $sql="SELECT * FROM `user_list`";
                $result=mysqli_query($con,$sql);
                $row = mysqli_num_rows($result);
              ?>
              <span class="number"><?php echo ''.$row.''?></span> 
            </div>
            <div class="box box3">
              <i class="uil uil-coins"></i>
              <span class="text">Total Earning</span>
              <span class="number">14,550 TK</span>
            </div>
          </div>
        </div>
      
        <div class="activity">
          <div class="title">
            <i class="uil uil-clock-three"></i>
            <span class="text">Recent Activity</span>
          </div>

          <div class="activity-data">
            <div class="data names">
              <span class="data-title">Name</span>
              <span class="data-list">Prem Shahi</span>
              <span class="data-list">Deepa Chand</span>
              <span class="data-list">Manisha Chand</span>
              <span class="data-list">Pratima Shahi</span>
              <span class="data-list">Man Shahi</span>
              <span class="data-list">Ganesh Chand</span>
              <span class="data-list">Bikash Chand</span>
            </div>
            <div class="data email">
              <span class="data-title">Email</span>
              <span class="data-list">premshahi@gmail.com</span>
              <span class="data-list">deepachand@gmail.com</span>
              <span class="data-list">prakashhai@gmail.com</span>
              <span class="data-list">manishachand@gmail.com</span>
              <span class="data-list">pratimashhai@gmail.com</span>
              <span class="data-list">manshahi@gmail.com</span>
              <span class="data-list">ganeshchand@gmail.com</span>
            </div>
            <div class="data joined">
              <span class="data-title">Joined</span>
              <span class="data-list">2022-02-12</span>
              <span class="data-list">2022-02-12</span>
              <span class="data-list">2022-02-13</span>
              <span class="data-list">2022-02-13</span>
              <span class="data-list">2022-02-14</span>
              <span class="data-list">2022-02-14</span>
              <span class="data-list">2022-02-15</span>
            </div>
            <div class="data type">
              <span class="data-title">Type</span>
              <span class="data-list">New</span>
              <span class="data-list">Member</span>
              <span class="data-list">Member</span>
              <span class="data-list">New</span>
              <span class="data-list">Member</span>
              <span class="data-list">New</span>
              <span class="data-list">Member</span>
            </div>
            <div class="data status">
              <span class="data-title">Status</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
              <span class="data-list">Liked</span>
            </div>
          </div>
        </div>
        
      </div>
    </section>
  </body>
</html>

<?php
  if (isset($_POST['logout'])) 
  {
    session_destroy();
    header("location:Admin_Panel_Login.php");
  }

?>