<?php
session_start();
if (!isset($_SESSION['SubAdminLoginEmail'])) {
  header("location:SubAdminLogin.php");
}
include '../connect.php';
$SearchText = $_SESSION['SubAdminLoginEmail'];
$sql_search = "SELECT * FROM `subadmin_list` WHERE email='$SearchText'";
$SearchResult = mysqli_query($con, $sql_search);
$row = mysqli_fetch_assoc($SearchResult);
$id = $row['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="SubAdmin.css" />

  <!----===== Iconscout CSS ===== -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <title>Sub-Admin Dashboard Panel</title>
</head>

<body>
  <nav>
    <a class="AdminHome" href="SubAdmin.php">
      <div class="logo-name">
        <div class="logo-image">
          <img src="../images/logo_dark.png" />
        </div>
        <span class="logo_name">Sub-Admin</span>
        
      </div>
    </a>


    <div class="menu-items">
      <ul class="nav-links">
        <li>
          <a href="SubAdmin.php">
            <i class="uil uil-estate"></i>
            <span class="link-name">Dahsboard</span>
          </a>
        </li>
        <li>
          <a href="view_ParkingInfo.php">
            <i class="uil uil-info-circle"></i>
            <span class="link-name">Your Parking Info</span>
          </a>
        </li>
        <li>
          <a href="view_SlotInfo.php">
            <i class="uil uil-arrows-shrink-h"></i>
            <span class="link-name">Slot Info</span>
          </a>
        </li>
        <li>
          <a href="view_parkingRequest.php">
            <i class="uil uil-car-sideview"></i>
            <span class="link-name">Parking Request</span>
          </a>
        </li>
        <li>
          <a href="view_bookingInfo.php">
            <i class="uil uil-car"></i>
            <span class="link-name">Booked Slot Info</span>
          </a>
        </li>
        <li>
            <a href="Payment.php">
              <i class="uil uil-bill"></i>
              <span class="link-name">Payment</span>
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
      <a href="ParkingPlaceForm.php">
        <div class="Add-Parking">
          <button type="submit" class="Add-Parking" name="AddParkingBtn">Add Parking Place</button>
        </div>
      </a>
      <div>
        
        <span class="admin_name"><?php echo $_SESSION['SubAdminLoginEmail'] ?></span>
        <img src="../images/profile.png" alt="" />
      </div>

    </div>

    <div class="dash-content">
      <div class="overview">
        <a href="SubAdmin.php">
          <div class="title">
            <i class="uil uil-car-sideview"></i>
            <span class="text">Dahsboard</span>
          </div>
        </a>
        <div class="boxes">

          <a class="box box1" href="view_parkingRequest.php">
            <div class="box box1">
              <i class="uil uil-car-sideview"></i>
              <span class="text">Request Pending</span>

              <?php
                $sql="SELECT * FROM `booking_request` WHERE place_id=$id";
                $result=mysqli_query($con,$sql);
                $row = mysqli_num_rows($result);
              ?>
              <span class="number"><?php echo ''.$row.''?></span>
            </div>
          </a>

          <a class="box box2" href="view_bookingInfo.php">
            <div class="box box2">
              <i class="uil uil-car"></i>
              <span class="text">Booked Slot</span>

              <?php
                $sql="SELECT * FROM `booked_list` WHERE place_id=$id";
                $result=mysqli_query($con,$sql);
                $row = mysqli_num_rows($result);
              ?>
              <span class="number"><?php echo ''.$row.''?></span>
            </div>
          </a>
          <a class="box box3">
            <div class="box box3">
              <i class="uil uil-coins"></i>
              <span class="text">Balance(TK)</span>

              <?php
                $sql = "SELECT Total_Transaction FROM `total_balance` WHERE sub_id=$id";
                $result=mysqli_query($con,$sql);
                $row = mysqli_fetch_assoc($result);
                if ($row!=0) {
                  $Total_Transaction = $row['Total_Transaction'];
                  echo '<span class="number">'.$Total_Transaction.'</span>';
                }
                else {
                  echo '<span class="number">0</span>';
                }
              ?>
              
            </div>
          </a>
          <a class="box box3" href="Payment.php">
            <div class="box box3">
              <i class="uil uil-dollar-alt"></i>
              <span class="text">Payable(TK)</span>

              <?php
                $sql = "SELECT * FROM `total_balance` WHERE sub_id='$id'";
                $result=mysqli_query($con,$sql);
                $row = mysqli_fetch_assoc($result);
                if ($row!=0) {
                  $amount = $row['Receivable'];
                  echo '<span class="number">'.$amount.'</span>';
                }
                else {
                  echo '<span class="number">0</span>';
                }
              ?> 
            </div>
          </a>

        </div>
      </div>


    </div>
  </section>
</body>

</html>

<?php
if (isset($_POST['logout'])) {
  session_destroy();
  header("location:SubAdminLogin.php");
}
?>