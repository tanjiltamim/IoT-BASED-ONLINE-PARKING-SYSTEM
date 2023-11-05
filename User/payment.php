<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';

  if (isset($_REQUEST['placeid'])) 
  {
    //Setting slot-booking page value to Session
    $_SESSION['placeid'] = $_REQUEST['placeid'];
    $_SESSION['slotNumber'] = $_REQUEST['slotNumber'];
    $_SESSION['priceperhour'] = $_REQUEST['priceperhour'];
    $_SESSION['user_id'] = $_REQUEST['user_id'];
    $_SESSION['user_name'] = $_REQUEST['name'];
    $_SESSION['user_phone'] = $_REQUEST['phone'];
    $_SESSION['vehicle_No'] = $_REQUEST['vehicleNo'];
    $_SESSION['arrival_Date'] = $_REQUEST['arrivalDate'];
    $_SESSION['arrival_Time'] = $_REQUEST['arrivalTime'];
    $_SESSION['departure_Date'] = $_REQUEST['departureDate'];
    $_SESSION['departure_Time'] = $_REQUEST['departureTime'];
  }

?>
<?php
//Getting value from slot-booking page
$placeid=$_SESSION['placeid'];
$slotNumber=$_SESSION['slotNumber'];
$priceperhour=$_SESSION['priceperhour'];
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];
$user_phone=$_SESSION['user_phone'];
$vehicle_No=$_SESSION['vehicle_No'];
$arrival_Date= strtotime($_SESSION['arrival_Date'])/60;
$arrival_Time= strtotime($_SESSION['arrival_Time'])/60;
$departure_Date= strtotime($_SESSION['departure_Date'])/60;
$departure_Time= strtotime($_SESSION['departure_Time'])/60;

//Time validation
$arrivalCheck = strtotime(("$_SESSION[arrival_Date] $_SESSION[arrival_Time]"));
$departureCheck = strtotime(("$_SESSION[departure_Date] $_SESSION[departure_Time]"));

//Calulation
$totalParkingTime=(($departure_Date+$departure_Time)-($arrival_Date+$arrival_Time))/60;
$totalRent=floor($totalParkingTime*$priceperhour);

//Getting Sub-Admin Number
$sql_search = "SELECT * FROM `subadmin_list` WHERE id='$placeid'";
$SearchResult = mysqli_query($con, $sql_search);
$row = mysqli_fetch_assoc($SearchResult);
$SubAdmin_phone = $row["phone"];


if(isset($_POST['confirm']))
{
  
  if ( $departureCheck<$arrivalCheck )
  {
    echo "<script>alert('Please select valid time!') </script>";
  }
  else
  {
    $paymentMethod = $_POST["paymentMethod"]; 
    $transactionId = $_POST["transactionId"];

    $sql = "INSERT INTO `booking_request` (user_id, 
                                           user_name, 
                                           user_phone, 
                                           vehicle_No, 
                                           place_id, 
                                           slot_No, 
                                           priceperhour, 
                                           arrival_date, 
                                           arrival_time, 
                                           departure_date, 
                                           departure_time, 
                                           totalparkinghour, 
                                           totalrentcost, 
                                           payment_method, 
                                           transaction_id, 
                                           booking_time)   
    values('$user_id',
           '$user_name', 
           '$user_phone', 
           '$vehicle_No', 
           '$placeid', 
           '$slotNumber', 
           '$priceperhour', 
           '$_SESSION[arrival_Date]', 
           '$_SESSION[arrival_Time]', 
           '$_SESSION[departure_Date]', 
           '$_SESSION[departure_Time]', 
           '$totalParkingTime', 
           '$totalRent', 
           '$paymentMethod', 
           '$transactionId',
            now() ) ";
    
    $insert = mysqli_query($con, $sql);
    if($insert)
    {
      echo "<script>alert('Your booking is received. You will be notified very soon!') </script>";
      header("location:user.php");
    }
    else
    {
      echo "<script>alert('Please submit everything correctly!') </script>";
    }
  }
    
    
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
  <title>Payment</title>
</head>

<body>
  <div class="container">
    <nav id="navBar">
      <a href="user.php"><img src="../images/logo.png" class="logo" /></a>
    </nav>
    <form method="POST">

      <header>Please Read The Payment System Carefully</header>
      <br>
      <p>1. Select payment method. <br>
         2. Send " <?php echo "$totalRent" ; ?>TK " to the number given below.<br>
         3. 0<?php echo "$SubAdmin_phone" ; ?> (bKash, Nagad, Rocket). <br>
         4. After sending money enter the "Transaction ID" and Click "Confirm".<br>
      </p>
      <br>

        <div class="form first">
          <div class="fields">
            <div class="input-field">
              <label for="">Total Parking Hour:</label>
              <input type="number" name="totalParkingTime" id="" class="form-control" placeholder="" value="<?php echo "$totalParkingTime" ; ?>" disabled/>
            </div>
            <br>
            <div class="input-field">
              <label for="">Total Rent Cost(TK):</label>
              <input type="number" name="totalRent" id="" class="form-control" placeholder="" value="<?php echo "$totalRent" ; ?>" disabled/>
            </div> 

            <div class="input-field">
              <label for="">Payment Method</label>
              <select name="paymentMethod" id="" required>
                <option disabled selected>Select payment method</option>
                <option>bKash</option>
                <option>Nagad</option>
                <option>Rocket</option>
              </select>
            </div>
            <div class="input-field">
                <label for="">Enter Transaction ID:</label>
                <input type="text" name="transactionId" id="" class="form-control" placeholder="Enter the transaction ID"  required/>
            </div>
            
          </div>

            <button type="submit" class="submit" name="confirm">Confirm</button>

        </div>
        
        

    </form>
  </div>

</body>
<script src="dateScript.js"></script>


</html>


