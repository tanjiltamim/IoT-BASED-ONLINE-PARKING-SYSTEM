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
          <input type="text" name="search-text" placeholder="Search here by Sub-Admin ID" required />
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
        <a href="Payment.php">
          <div class="title">
            <i class="uil uil-bill"></i>
            <span class="text">Payment</span>
          </div>
        </a>
      </div>

      <div class="activity">
        <table class="styled-table">
          <thead>
            <tr>
                <th scope="col">Sub-Admin ID</th>
                <th scope="col">Total Transaction</th>
                <th scope="col">Admin Receivable(20%)</th>
                
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_POST['search-btn'])) {
              $SearchText = $_POST['search-text'];
              $sql_search = "SELECT * FROM `total_balance` WHERE sub_id='$SearchText'";
              $SearchResult = mysqli_query($con, $sql_search);
              if (mysqli_num_rows($SearchResult) > 0) {
                while ($row = mysqli_fetch_assoc($SearchResult)) {
                    $Sub_Id = $row["sub_id"];
                    $Total_Transaction = $row["Total_Transaction"];
                    $Admin_Receivable = (20 * $Total_Transaction)/100;
                    

                  echo '
                                <tr>
                                    <td>' . $Sub_Id . '</td>
                                    <td>' . $Total_Transaction . '</td>
                                    <td>' . $Admin_Receivable . '</td>
                                </tr>';
                }
              } else {
                echo '
                            <tr>
                              <td colspan="3">No Record Found</td>
                            </tr>
                            ';
              }
            } else {
              $sql = "SELECT * FROM `total_balance`";
              $result = mysqli_query($con, $sql);
              if ($result) 
              {
                while ($row = mysqli_fetch_assoc($result)) {
                    $Sub_Id = $row["sub_id"];
                    $Total_Transaction = $row["Total_Transaction"];
                    $Admin_Receivable = $row["Receivable"];

                  echo '
                                <tr>
                                    <td>' . $Sub_Id . '</td>
                                    <td>' . $Total_Transaction . ' TK</td>
                                    <td>' . $Admin_Receivable . ' TK</td>
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