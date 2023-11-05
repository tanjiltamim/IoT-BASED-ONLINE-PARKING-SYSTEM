<?php
session_start();
if (!isset($_SESSION['SubAdminLoginEmail'])) {
  header("location:SubAdminLogin.php");
}
include '../connect.php';

//Fetching Subadmin Information
$SearchText = $_SESSION['SubAdminLoginEmail'];
$sql_search = "SELECT * FROM `subadmin_list` WHERE email='$SearchText'";
$SearchResult = mysqli_query($con, $sql_search);
$row = mysqli_fetch_assoc($SearchResult);
$id = $row['id'];
$name = $row["name"];
$phone = $row["phone"];
$email = $row["email"];
$password = $row["password"];
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
      <a href="">
        <div class="Add-Parking">
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
            <i class="uil uil-arrows-shrink-h"></i>
            <span class="text">Slot Information</span>
          </div>
        </a>
        
      </div>
      <div class="activity">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th scope="col">Slot No.</th>
                            <th scope="col">Slot Size</th>
                            <th scope="col">Slot Price/Hour</th>
                            <th scope="col">Slot Status</th>
                            <th scope="col">Booking Status</th>
                        </tr>

                            
                    </thead>
                    <tbody>
                    <?php
                        $subadminid = $id;
                        $slotSearch = "SELECT * FROM `slotlist_subid:$subadminid`";
                        $SlotSearchResult = mysqli_query($con, $slotSearch);
                        if (mysqli_num_rows($SlotSearchResult) > 0) 
                        {
                            while ($row = mysqli_fetch_assoc($SlotSearchResult)) 
                            {
                                    $slotNumber = $row['Slot_Id'];
                                    $slotsize = $row["Slot_Size"];
                                    $priceperhour = $row["PricePerHour"];
                                    $slotstatus = $row["Slot_Status"];
                                    $bookingstatus = $row["Booking_Status"];
                                    


                                echo '
                                <tr>

                                    <td>' . $slotNumber . '</td>
                                    <td>' . $slotsize . '</td>
                                    <td>' . $priceperhour . '</td>
                                    <td>' . $slotstatus . '</td>
                                    <td>' . $bookingstatus . '</td>


                                </tr>';
                            }
                        } 
                        else 
                        {
                            echo '
                            <tr>
                                <td colspan="5">No Parking Slot Found</td>
                            </tr>';
                        }
                        

                    ?>
                    </tbody>
                </table>
                <div class="activity-data">

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