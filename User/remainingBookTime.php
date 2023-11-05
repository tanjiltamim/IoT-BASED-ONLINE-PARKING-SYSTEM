<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';

$SearchText = $_SESSION['UserLoginEmail'];
$sql_search = "SELECT * FROM `user_list` WHERE email='$SearchText'";
$SearchResult = mysqli_query($con, $sql_search);
$row = mysqli_fetch_assoc($SearchResult);
$id = $row['id'];



  if (isset($_REQUEST['booking_id'])) 
  {
    //Setting yourBooking page value to Session
    $_SESSION['booking_id'] = $_REQUEST['booking_id'];
    
  }
?>
<?php

if(isset($_POST['request']))
{
  $bookingID=$_SESSION['booking_id'];
  $bookedList = "SELECT * FROM `booking_request` WHERE booking_id='$bookingID'";
  $bookedListResult = mysqli_query($con, $bookedList);
  $row = mysqli_fetch_assoc($bookedListResult);
  $placeid = $row['place_id'];
  $arrival_Date = $row['arrival_date'];
  $arrival_Time = $row['arrival_time'];
  $departure_Date = $row['departure_date'];
  $departure_Time = $row['departure_time'];
  $totalParkingHour = $row['totalparkinghour'];
  $totalrentcost = $row["totalrentcost"];
  $slot_No = $row["slot_No"];
}


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
        <h2 class="heading">Your Parking Time Will Start in</h2>
        
        <div class="parking_status"> 
          
            <?php 
                date_default_timezone_set('Asia/Dhaka');

                $newArrival = ("$arrival_Date $arrival_Time");
                $newArrivalTime=strtotime($newArrival);
              
                $diff=$newArrivalTime-time();

                if ($diff>=0) {
                  $Days=$diff/86400;
                  $cleanDays=floor($Days);//Days
  
                  $HoursGap=$diff-($cleanDays*86400);
                  $Hours=$HoursGap/3600;
                  $cleanHours=floor($Hours);//Hours
  
                  $MinutesGap=($Hours*3600)-($cleanHours*3600);
                  $Minutes=$MinutesGap/60;
                  $cleanMinutes=floor($Minutes);//Minutes
  
                  $Seconds=floor(($Minutes*60)-($cleanMinutes*60));//Seconds
  
                  
  
                  echo '
                  <div>
                    <p class="remaingTime"><br><br>'.$cleanDays.' Day  : '.$cleanHours.' Hour  : '.$cleanMinutes.' Minute  : '.$Seconds.' Seconds</p>
                  </div>';
                }
                else {

                  $sqlInsert="INSERT INTO `booked_list` SELECT * FROM `booking_request` WHERE booking_id=$bookingID";
                  $insert = mysqli_query($con, $sqlInsert);
                
                  $sqlBookingStatus="UPDATE `slotlist_subid:$placeid` SET Booking_Status ='Booked'  WHERE Slot_Id=$slot_No";
                  $insertBookingStatus= mysqli_query($con, $sqlBookingStatus);
                
                  $sqlBalance="INSERT INTO `balance_subid:$placeid` (Booking_Id, Total_Paid, Booked_Date)   
                    values('$bookingID', '$totalrentcost', now()) ";
                  $sqlBalanceInsert = mysqli_query($con, $sqlBalance);

                  $sqlTotalBalance = "UPDATE `total_balance` SET 	Total_Transaction =	Total_Transaction+'$totalrentcost'  WHERE sub_id=$placeid";
                  $resultTotalBalance = mysqli_query($con, $sqlTotalBalance);

                  $sqlReceivable = "UPDATE `total_balance` SET 	Receivable = Receivable+((20 * '$totalrentcost')/100)  WHERE sub_id=$placeid";
                  $SqlReceivableRun = mysqli_query($con, $sqlReceivable);
                
                  $sqlDelete="DELETE FROM `booking_request` WHERE `booking_id` =$bookingID ";
                  $delete = mysqli_query($con, $sqlDelete);


                  echo '
                  <div>
                    <p class="remaingTime"><br><br>Waiting time is over!<br>Please check the booked slot!</p>
                  </div>';
                }
                
               

            
            ?>


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

    <script>

     

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