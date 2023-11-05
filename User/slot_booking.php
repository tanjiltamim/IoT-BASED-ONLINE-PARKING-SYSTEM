<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';

//User information
  $SearchText = $_SESSION['UserLoginEmail'];
  $sql_search = "SELECT * FROM `user_list` WHERE email='$SearchText'";
  $SearchResult = mysqli_query($con, $sql_search);
  $row = mysqli_fetch_assoc($SearchResult);
  $id = $row['id'];
  $name = $row["name"];
  $phone = $row["phone"];
  $email = $row["email"];
  $vehicleNo= $row["vehicleNo"];

  //Getting value from parking status page
  if (isset($_REQUEST['placeid'])) 
  {
    $_SESSION['placeid'] = $_REQUEST['placeid'];
    $_SESSION['slotNumber'] = $_REQUEST['slotNumber'];
    $_SESSION['priceperhour'] = $_REQUEST['priceperhour'];
  }
  
?>
<?php

$placeid=$_SESSION['placeid'];
$slotNumber=$_SESSION['slotNumber'];
$priceperhour=$_SESSION['priceperhour'];



if (isset($_POST['submit']))
{
    $date=$_POST['priceperhour'];
    echo ''.$date.'<br>';

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="slot_booking.css" />

  <!----===== Iconscout CSS ===== -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <title>Booking</title>
</head>

<body>
  <div class="container">
    <nav id="navBar">
      <a href="user.php"><img src="../images/logo.png" class="logo" /></a>
    </nav>
    <form action="payment.php " method="POST">

      <header>Booking</header>

    
        <div class="form first">
          <div class="fields">

            <div class="input-field">
              <label for="">Name:</label>
              <?php echo'<input type="text" name="name" id="" class="form-control" placeholder="" value="'.$name.'" disabled/>';?>
            </div>
            
            <div class="input-field">
              <label for="">Phone:</label>
              <?php echo'<input type="number" name="number" id="" class="form-control" placeholder="" value="0'.$phone.'" disabled/>';?>
            </div>
            <div class="input-field">
              <label for="">Vehicle Number:</label>
              <?php echo'<input type="text" name="vehicleNo" id="" class="form-control" placeholder="Enter vehicle number" value="'.$vehicleNo.'" required/>';?>
            </div>

            <div class="input-field">
              <label for="">Arrival Date:</label>
              <input type="date" name="arrivalDate" id="arrivalDate" class="form-control" placeholder="" value="" required/>
            </div>
            <div class="input-field">
              <label for="">Arrival Time:</label>
              <input type="time" name="arrivalTime" id="arrivalTime" class="form-control" placeholder="" value="" required/>
            </div>

            <div class="input-field">
              <label for="">Departure Date:</label>
              <input type="date" name="departureDate" id="departureDate" class="form-control" placeholder="" value="" required/>
            </div>
            <div class="input-field">
              <label for="">Departure Time:</label>
              <input type="time" name="departureTime" id="departureTime" class="form-control" placeholder="" value="" required/>
            </div>

            <div class="input-field">
              <label for="">Slot Number:</label>
              <?php echo'<input type="text" name="slotNumber" id="" class="form-control" placeholder="" value="'.$slotNumber.'" disabled/>';?>
            </div>
            <div class="input-field">
              <label for="">Price/Hour:</label>
              <?php echo'<input type="number" name="priceperhour" class="form-control" value="'.$priceperhour.'" disabled/>';?>
            </div>
            <?php echo'
            <input name="placeid" type="hidden" value="'.$placeid.'">  
            <input name="slotNumber" type="hidden" value="'.$slotNumber.'">  
            <input name="priceperhour" type="hidden" value="'.$priceperhour.'">
            <input name="user_id" type="hidden" value="'.$id.'">
            <input name="name" type="hidden" value="'.$name.'">
            <input name="phone" type="hidden" value="'.$phone.'"> '; ?>
            
        </div>
        <button type="submit" class="submit" name="submit">Next</button>

        </div>
        
        

    </form>
  </div>

</body>
<script src="dateScript.js"></script>


</html>




