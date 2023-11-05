<?php
session_start();
if (!isset($_SESSION['AdminLoginName'])) {
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
    <a class="AdminHome" href="Admin_Panel.php">
      <div class="logo-name">
        <div class="logo-image">
          <img src="../images/logo_dark.png" />
        </div>
        <span class="logo_name">Admin-Panel</span>
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
      <form action="" method="POST" class="search-box">
        <div class="search-box">
          <i class="uil uil-search"></i>
          <input type="text" name="search-text" placeholder="Search here by User ID or Sub-Admin ID" required />
          <button type="submit" class="search" name="search-btn">Search</button>
        </div>
      </form>

      <div>
        <span class="admin_name"><?php echo $_SESSION['AdminLoginName'] ?></span>
        <img src="../images/profile.png" alt="" />
      </div>

    </div>

    <div class="dash-content">
      <div class="overview">
        <a href="Booking_History.php">
          <div class="title">
            <i class="uil uil-history"></i>
            <span class="text">Booking History</span>
          </div>
        </a>
      </div>

      <div class="activity">
        <table class="styled-table">
          <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">User Name</th>
                <th scope="col">User Phone</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Sub-Admin ID</th>
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
                <th scope="col">Booking ID</th>
                <th scope="col">Booking Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_POST['search-btn'])) {
              $SearchText = $_POST['search-text'];
              $sql_search = "SELECT * FROM `removed_bookedlist` WHERE user_id='$SearchText' OR place_id='$SearchText'";
              $SearchResult = mysqli_query($con, $sql_search);
              if (mysqli_num_rows($SearchResult) > 0) {
                while ($row = mysqli_fetch_assoc($SearchResult)) {
                    $user_id = $row["user_id"];
                    $user_name = $row["user_name"];
                    $user_phone = $row["user_phone"];
                    $vehicle_No = $row["vehicle_No"];
                    $SubID = $row["place_id"];
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
                                    <td>' . $user_id . '</td>
                                    <td>' . $user_name . '</td>
                                    <td>' . $user_phone . '</td>
                                    <td>' . $vehicle_No . '</td>
                                    <td>' . $SubID . '</td>
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
                                    <td>' . $booking_id . '</td>
                                    <td>' . $booking_time . '</td>
                                </tr>';
                }
              } else {
                echo '
                            <tr>
                              <td colspan="16">No Record Found</td>
                            </tr>
                            ';
              }
            } else {
              $sql = "SELECT * FROM `removed_bookedlist`";
              $result = mysqli_query($con, $sql);
              if ($result) 
              {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row["user_id"];
                    $user_name = $row["user_name"];
                    $user_phone = $row["user_phone"];
                    $vehicle_No = $row["vehicle_No"];
                    $SubID = $row["place_id"];
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
                                    <td>' . $user_id . '</td>
                                    <td>' . $user_name . '</td>
                                    <td>' . $user_phone . '</td>
                                    <td>' . $vehicle_No . '</td>
                                    <td>' . $SubID . '</td>
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
                                    <td>' . $booking_id . '</td>
                                    <td>' . $booking_time . '</td>

                                </tr>';
                }
              }
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
  header("location:Admin_Panel_Login.php");
}
?>