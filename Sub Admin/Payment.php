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


if(isset($_POST['confirm']))
{
    $amount = $_POST["totalAmount"];
    $paymentMethod = $_POST["paymentMethod"]; 
    $transactionId = $_POST["transactionId"];

    $sql = "INSERT INTO `payment_request` (sub_id, 
                                           payment_method, 
                                           amount, 
                                           transaction_id)   
    values('$id',
           '$paymentMethod', 
           '$amount', 
           '$transactionId') ";
    
    $insert = mysqli_query($con, $sql);
    if($insert)
    {
      echo "<script>alert('Your payment request is received. You will be notified very soon!') </script>";
    }
    else
    {
      echo "<script>alert('Please submit everything correctly!') </script>";
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
            <i class="uil uil-bill"></i>
            <span class="text">Payment</span>
          </div>
        </a>
        
      </div>
    <div class="activity">
        <div class="payment">
            <?php
            $sql = "SELECT * FROM `total_balance` WHERE sub_id='$id'";
              $result = mysqli_query($con, $sql);
              if ($result) 
              {
                while ($row = mysqli_fetch_assoc($result)) {
                    $Admin_Receivable = $row["Receivable"];

              if($Admin_Receivable>0)  {

                echo 
                ' 
                  <p class="SubadminPayable">Your total Payable: '.$Admin_Receivable.' TK</p>
                  <div class="container">
                  <form method="POST">
      
                    <header>Please Read The Payment System Carefully</header>
                    <br>
                    <p class="instructions">1. Select payment method. <br>
                      2. Send <b>'.$Admin_Receivable.' TK</b> to the number given below.<br>
                      3. <b>01818-557778</b> (bKash, Nagad, Rocket). <br>
                      4. After sending money enter the <b>Transaction ID</b> and Click <b>Confirm</b>.<br>
                    </p>
                    <br>
      
                      <div class="form first">
                        <div class="fields">
                          <br>
                          <div class="input-field">
                            <label for="">Total Payable(TK):</label>
                            <input type="number" name="totalAmount" id="" class="form-control" placeholder="" value="'.$Admin_Receivable.'" required/>
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
                ';
                }
                else {
                  echo 
                ' 
                  <p class="SubadminPayable">Your total Payable: 0 TK</p>
                ';
                }
                }
              }
              
            ?>
        </div>
      
        
        

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