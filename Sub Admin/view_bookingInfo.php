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

<?php 

if(isset($_POST['remove']))
{
  $booking_id = $_POST["booking_id"];
  $slotNo = $_POST["slot_No"];


  $sqlInsert="INSERT INTO `removed_bookedlist` SELECT * FROM `booked_list` WHERE booking_id=$booking_id";
  $insert = mysqli_query($con, $sqlInsert);

  $sqlDelete="DELETE FROM `booked_list` WHERE `booking_id` =$booking_id ";
  $delete = mysqli_query($con, $sqlDelete);

  $sqlBookingStatus="UPDATE `slotlist_subid:$id` SET Booking_Status ='Available'  WHERE Slot_Id=$slotNo";
  $insertBookingStatus= mysqli_query($con, $sqlBookingStatus);

}

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
            <i class="uil uil-car"></i>
            <span class="text">Booked Slot Information</span>
          </div>
        </a>
        
      </div>
      <div class="activity">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">User Phone</th>
                            <th scope="col">Vehicle Number</th>
                            <th scope="col">Slot No.</th>
                            <th scope="col">Pricer/Hour</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Departure Date</th>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Total Parking Hour</th>
                            <th scope="col">Total Rent Cost</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Booking Time</th>
                            <th scope="col">Remove</th>

                        </tr>

                            
                    </thead>
                    <tbody>
                        <?php
                        
                            $bookingRequest = "SELECT * FROM `booked_list` WHERE place_id='$id'";
                            $bookingRequestResult = mysqli_query($con, $bookingRequest);
                            if (mysqli_num_rows($bookingRequestResult) > 0) {
                                while ($row = mysqli_fetch_assoc($bookingRequestResult)) {
                                    $user_name = $row["user_name"];
                                    $user_phone = $row["user_phone"];
                                    $vehicle_No = $row["vehicle_No"];
                                    $slot_No = $row["slot_No"];
                                    $priceperhour = $row["priceperhour"];
                                    $arrival_date = $row["arrival_date"];
                                    $arrival_time = $row["arrival_time"];
                                    $departure_date = $row["departure_date"];
                                    $departure_time = $row["departure_time"];
                                    $totalparkinghour = $row["totalparkinghour"];
                                    $totalrentcost = $row["totalrentcost"];
                                    $payment_method = $row["payment_method"];
                                    $transaction_id = $row["transaction_id"];
                                    $booking_time = $row["booking_time"];

                                    $booking_id = $row["booking_id"];


                                    echo '
                                <tr>
                                    <td>' . $user_name . '</td>
                                    <td>' . $user_phone . '</td>
                                    <td>' . $vehicle_No . '</td>
                                    <td>' . $slot_No . '</td>
                                    <td>' . $priceperhour . '</td>
                                    <td>' . $arrival_date . '</td>
                                    <td>' . $arrival_time . '</td>
                                    <td>' . $departure_date . '</td>
                                    <td>' . $departure_time . '</td>
                                    <td>' . $totalparkinghour . '</td>
                                    <td>' . $totalrentcost . '</td>
                                    <td>' . $payment_method . '</td>
                                    <td>' . $transaction_id . '</td>
                                    <td>' . $booking_time . '</td>

                                    <td>
                                    <form method="post">
                                        <input name="booking_id" type="hidden" value="'.$booking_id.'">
                                        <input name="slot_No" type="hidden" value="'.$slot_No.'">
                                        <button name="remove">Remove</button>
                                    </form>

                                    </td> 

                                </tr>';
                                }
                            } else {
                                echo '
                            <tr>
                              <td colspan="5">No Booking Found</td>
                            </tr>
                            ';
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