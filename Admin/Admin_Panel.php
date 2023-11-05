<?php
  session_start();
  if(!isset($_SESSION['AdminLoginName']))
  {
    header("location:Admin_Panel_Login.php");
  }
  include '../connect.php';
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
            <img src="../images/logo_dark.png" alt="Logo"/>
          </div>
          <span class="logo_name" >Admin-Panel</span>
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
          <li>
            <a href="All_Pending_Booking.php">
              <i class="uil uil-angle-double-right"></i>
              <span class="link-name">Pending Booking</span>
            </a>
          </li>
          <li>
            <a href="Current_Booked_Slot.php">
              <i class="uil uil-arrows-merge"></i>
              <span class="link-name">Booked Slot</span>
            </a>
          </li>
          <li>
            <a href="Booking_History.php">
              <i class="uil uil-history"></i>
              <span class="link-name">Booking History</span>
            </a>
          </li>
          <li>
            <a href="Removed_Booking_Request.php">
              <i class="uil uil-trash-alt"></i>
              <span class="link-name">Removed Booking Request</span>
            </a>
          </li>
          <li>
            <a href="Overtime.php">
              <i class="uil uil-tachometer-fast-alt"></i>
              <span class="link-name">Overtime List</span>
            </a>
          </li>
          <li>
            <a href="Payment.php">
              <i class="uil uil-bill"></i>
              <span class="link-name">Payment</span>
            </a>
          </li>
          <li>
            <a href="Payment_Request.php">
              <i class="uil uil-angle-double-down"></i>
              <span class="link-name">Payment Request</span>
            </a>
          </li>
          <li>
            <a href="Payment_History.php">
              <i class="uil uil-receipt"></i>
              <span class="link-name">Payment History</span>
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
          <!--  <i class="uil uil-search"></i>
            <input type="text" name="search-text" placeholder="Search here by ID or Email" required/>
            <button type="submit" class="search" name="search-btn">Search</button>-->
          </div>
        </form> 
          
        <div>
          <span class="admin_name"><?php echo $_SESSION['AdminLoginName']?></span>
          <img src="../images/profile.png" alt="Profile Pic" />
        </div>
        
      </div>

      <div class="dash-content">
        <div class="overview">
            <a href="Admin_Panel.php">
              <div class="title">
                <i class="uil uil-estate"></i>
                <span class="text">Dahsboard</span>
              </div>
            </a>
          <div class="boxes">
            <a class="box box1" href="view_SubAdminList.php">

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

            </a>

            <a class="box box2" href="view_UserList.php">
              
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
            </a>

            <a class="box box3">
              <div class="box box3">
                <i class="uil uil-coins"></i>
                <span class="text">Total Transaction(TK)</span>

                <?php
                  $sql = "SELECT SUM(Total_Transaction) FROM `total_balance`";
                  $result=mysqli_query($con,$sql);
                  $row = mysqli_fetch_assoc($result);
                  $current_balance = $row['SUM(Total_Transaction)'];
                ?>
                <span class="number"><?php echo ''.$current_balance.''?></span>
              </div>
            </a>
            <a class="box box2" href="Current_Booked_Slot.php">
              <div class="box box2">
                <i class="uil uil-arrows-merge"></i>
                <span class="text">Current Booked Slot</span>

                <?php
                  $sql="SELECT * FROM `booked_list`";
                  $result=mysqli_query($con,$sql);
                  $row = mysqli_num_rows($result);
                ?>
                <span class="number"><?php echo ''.$row.''?></span> 
              </div>
            </a>

            <a class="box box3" href="Payment_History.php">
              <div class="box box3">
                <i class="uil uil-dollar-alt"></i>
                <span class="text">Admin Balance(TK)</span>
                <?php
                  $sql="SELECT SUM(amount) FROM `payment_history`";
                  $result=mysqli_query($con,$sql);
                  $row = mysqli_fetch_assoc($result);
                  $balance = $row['SUM(amount)'];
                ?>
                <span class="number"><?php echo ''.$balance.''?></span> 
              </div>
            </a>

            <a class="box box1" href="Payment_Request.php">
              <div class="box box1">
                <i class="uil uil-angle-double-down"></i>
                <span class="text">Payment Request</span>

                <?php
                  $sql="SELECT * FROM `payment_request`";
                  $result=mysqli_query($con,$sql);
                  $row = mysqli_num_rows($result);
                ?>
                <span class="number"><?php echo ''.$row.''?></span> 
              </div>
            </a>
            

           

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