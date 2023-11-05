<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';
?>
<?php
//User information
$SearchText = $_SESSION['UserLoginEmail'];
$sql_search = "SELECT * FROM `user_list` WHERE email='$SearchText'";
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
    <link rel="stylesheet" href="user.css" />
    <title>ParkO | Book Your Parking</title>
  </head>
  <body>
    <div class="header">
      <nav id="navBar">
        <a href="user.php"><img src="../images/logo.png" class="logo" /></a>

        <ul class="nav-links">
          <li>
            <a href="#" class="btnHow" onclick="openPopup()">How it works</a>
          </li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="user_profile.php">Your Profile</a></li>
          <li><a href="yourBooking.php">Your Booking</a></li>
        </ul>

        <ul class="login-register">
          <li>
            
            <form method="POST"> 
              <button name="logout" class="logout-btn">LOG OUT</button>    
            </form>

          </li>
        </ul>

        <img src="../images/menu.png" class="menubar" onclick="togglebtn()" />
      </nav>
        <h2 class="heading">Pending Request</h2>
        <div class="parking_status">
            
            <table class="styled-table-location">
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
                            <th scope="col">Remaining Time</th>

                        </tr>       
                    </thead>
                    <tbody>
                    <?php
                       $bookingRequest = "SELECT * FROM `booking_request` WHERE user_id='$id'";
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
                                    <form action="remainingBookTime.php" method="post">
                                        
                                        <input name="booking_id" type="hidden" value="'.$booking_id.'">
                                        <button name="request">View</button>
                                        
                                    </form>

                                </td>
                           </tr>';
                           }
                       } else {
                           echo '
                       <tr>
                         <td colspan="15">No Booking Found</td>
                       </tr>
                       ';
                       }
                   
                        

                    ?>
                    </tbody>
            </table>
                    
        </div>
        <h2 class="heading">Booked Slot</h2>
        <div class="parking_status">
            
            <table class="styled-table-location">
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
                            <th scope="col">Remaining Time</th>

                        </tr>       
                    </thead>
                    <tbody>
                    <?php
                       $bookingRequest = "SELECT * FROM `booked_list` WHERE user_id='$id'";
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
                                    <form action="remainingParkingTime.php" method="post">
                                        
                                        <input name="booking_id" type="hidden" value="'.$booking_id.'">
                                        <button name="booked">View</button>
                                        
                                    </form>

                                </td> 


                           </tr>';
                           }
                       } else {
                           echo '
                       <tr>
                         <td colspan="15">No Booking Found</td>
                       </tr>
                       ';
                       }
                   
                        

                    ?>
                    </tbody>
            </table>
                    
        </div>
        
        <h2 class="heading">Rejected Request</h2>
        <div class="parking_status">
            
            <table class="styled-table-location">
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

                        </tr>       
                    </thead>
                    <tbody>
                    <?php
                       $bookingRequest = "SELECT * FROM `removed_bookingrequest` WHERE user_id='$id'";
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
                           </tr>';
                           }
                       } else {
                           echo '
                       <tr>
                         <td colspan="15">No Booking Found</td>
                       </tr>
                       ';
                       }
                   
                        

                    ?>
                    </tbody>
            </table>
                    
        </div>
        

      

      <div class="popup" id="popup">
        <p>
          <b>1.</b> Find your parking lot by searching the name of the location
          or address.
        </p>
        <p><b>2.</b> See prices, distance and choose accordingly.</p>
        <p><b>3.</b> And finally, park your car.</p>
        <button type="button" onclick="closePopup()">OK</button>
      </div>
    </div>
    

    <script>
      var navBar = document.getElementById("navBar");
      function togglebtn() {
        navBar.classList.toggle("hidemenu");
      }
      function openPopup() {
        popup.classList.add("open-popup");
      }
      function closePopup() {
        popup.classList.remove("open-popup");
      }

      let popup = document.getElementById("popup");
    </script>


  </body>
</html>


<?php
  if (isset($_POST['logout'])) 
  {
    session_destroy();
    header("location:user_login.php");
  }

?>