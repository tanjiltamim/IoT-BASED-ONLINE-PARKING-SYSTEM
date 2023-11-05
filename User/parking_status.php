<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';
?>
<?php
if (isset($_GET['placeid'])) 
{
    $placeid = $_GET['placeid'];
    $sql_search = "SELECT * FROM `parkingplace` where id='$placeid' ";
    $SearchResult = mysqli_query($con, $sql_search);
    if (mysqli_num_rows($SearchResult) > 0) 
    {
        $row = mysqli_fetch_assoc($SearchResult);
        $thana = $row['thana'];
        $fulladdress = $row['fulladdress'];
        $ward = $row['ward'];
        $opentime = $row['opentime'];
        $closetime = $row['closetime'];
        $parkingcategory = $row['parkingcategory'];
        $parkingplace = $row['parkingplace'];
        $facility = $row['facility'];
        $guardnumber = $row['guardnumber'];

    }
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
        <h2 class="heading">Parking Details</h2>
        <div class="parking_status">
            
            <table class="styled-table-location">
                    <thead>
                    
                        <tr>
                            <th scope="col">Location</th>
                            <th scope="col">Ward No.</th>
                            <th scope="col">Full Address</th>
                            <th scope="col">Parking Category</th>
                            <th scope="col">Facility</th>
                            <th scope="col">Parking Place</th>
                            <th scope="col">Opening Time</th>
                            <th scope="col">Colsing Time</th>
                            <th scope="col">Guard Number</th>

                        </tr>       
                    </thead>
                    <tbody>
                    <?php
                        echo '
                        <tr>
                            <th scope="row">' . $thana . '</th>
                            <td>' . $ward . '</td>
                            <td>' . $fulladdress . '</td>
                            <td>' . $parkingcategory . '</td>
                            <td>' . $facility . '</td>
                            <td>' . $parkingplace . '</td>
                            <td>' . $opentime . '</td>
                            <td>' . $closetime . '</td>
                            <td>' . $guardnumber . '</td>
                        </tr>';
                        

                    ?>
                    </tbody>
            </table>
                    
        </div>
        <div class="parking_status">
        <table class="styled-table-location">
                    <thead>
                    
                        <tr>
                            <th scope="col">Slot No.</th>
                            <th scope="col">Slot Size</th>
                            <th scope="col">Price/Hour</th>
                            <th scope="col">Slot Status</th>
                            <th scope="col">Booking Status</th>
                            <th scope="col">Book</th>

                        </tr>       
                    </thead>
                    <tbody>
                    <?php
                            $sql_search = "SELECT * FROM `slotlist_subid:$placeid`";
                            $SearchResult = mysqli_query($con, $sql_search);
                            if (mysqli_num_rows($SearchResult) > 0) {
                                while ($row = mysqli_fetch_assoc($SearchResult)) {
                                    $slotNumber = $row['Slot_Id'];
                                    $slotsize = $row["Slot_Size"];
                                    $priceperhour = $row["PricePerHour"];
                                    $slotstatus = $row["Slot_Status"];
                                    $bookingstatus = $row["Booking_Status"];
                                    


                              echo '<tr>
                                

                                   <td>' . $slotNumber . '</td>
                                    <td>' . $slotsize . '</td>
                                    <td>' . $priceperhour . '</td>
                                    <td>' . $slotstatus . '</td> 
                                    <td>' . $bookingstatus . '</td> ';
                                   if ($bookingstatus=="Booked") 
                                   {
                                        echo' 
                                        <td>
                                        <button disabled>Book</button>
                                        </td>';
                                   }
                                   else
                                   {
                                        echo'
                                        <td>

                                          <form action="slot_booking.php" method="post">
                                            <input name="placeid" type="hidden" value="'.$placeid.'">  
                                            <input name="slotNumber" type="hidden" value="'.$slotNumber.'">  
                                            <input name="priceperhour" type="hidden" value="'.$priceperhour.'">  
                                            <button type="book">Book</button>
                                          </form>

                                        </td>
                                        ';
                                   } 
                                    

                              echo'</tr>';
                                }
                            } 
                            else 
                            {
                                echo '
                            <tr>
                              <td colspan="4">No Parking Slot Found</td>
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