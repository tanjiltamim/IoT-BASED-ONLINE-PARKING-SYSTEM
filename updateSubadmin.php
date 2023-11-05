<?php

include ('connect.php');
$id=$_GET['updateid'];
$sql="Select * from `subadminlist` where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name = $row["name"];
$email = $row["email"];
$mobile = $row["mobile"];
$address = $row["address"];
$security =$row["security"];
$division = $row["division"];
$bike = $row["bike"];
$bikeslot = $row["bikeslot"];
$car = $row["car"];
$carslot = $row["carslot"];
$opentime = $row["opentime"];
$endtime = $row["endtime"];
$placecategory =$row["placecategory"];
$facility =$row["facility"];
$parkingplace =$row["parkingplace"];



if(isset($_POST['submit']))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $security =$_POST["security"];
    $division = $_POST["division"];
    $bike = $_POST["bike"];
    $bikeslot = $_POST["bikeslot"];
    $car = $_POST["car"];
    $carslot = $_POST["carslot"];
    $opentime = $_POST["opentime"];
    $endtime = $_POST["endtime"];
    $placecategory =$_POST["placecategory"];
    $facility =$_POST["facility"];
    $parkingplace =$_POST["parkingplace"];

    $sql="update `subadminlist`set id=$id,  name='$name',email='$email',mobile=$mobile, address='$address',security=$security,division='$division',bike='$bike',bikeslot=$bikeslot, 
    car='$car' , carslot=$carslot, opentime='$opentime', endtime='$endtime',placecategory='$placecategory',facility='$facility',parkingplace='$parkingplace'   
    where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
       // echo "updated successfully";
       header('location:admin.php');
    }else{
        die(mysqli_error($con));
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
    <link rel="stylesheet" href="SubAdminForm.css" />

    <!----===== Iconscout CSS ===== -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <title>Registration</title>
  </head>
  <body>
    <div>
      
    </div>
    <div class="container">
    <nav id="navBar">
        <a href="index.html"><img src="images/logo.png" class="logo" /></a>
    </nav>
    <form method="post"> 

      <header>Registration Form</header>

      <form action="#">
        <div class="form first">
          <div class="fields">

            <div class="input-field">
              <label>Full Name</label>
              <input type="text" name="name" id="" class="form-control" placeholder="Enter your name" required value=<?php echo $name;?>>
            </div>

            <div class="input-field">
              <label>Email</label>
              <input type="text" name="email" id="" class="form-control" placeholder="Enter your email address" required value=<?php echo $email;?>>
            </div>

            <div class="input-field">
              <label>Mobile Number</label>
              <input type="number" name="mobile" id="" class="form-control" placeholder="Enter mobile number" required value=<?php echo $mobile;?>>
            </div>

            <div class="input-field">
              <label for="">Full address:</label>
              <input type="string" name="address" id="" class="form-control" placeholder="Enter parking address" value=<?php echo $address;?>>
            </div>

            <div class="input-field">
              <label for="">Security Guard Number(if available):</label>
              <input type="number" name="security" id="" class="form-control" placeholder="Enter security guard number" value=<?php echo $security;?>>
            </div>

            <div class="input-field">
              <label for="">Division:</label>
              <input type="text" name="division" id="" class="form-control" placeholder="Enter the division" required value=<?php echo $division;?>>
            </div>
            

            <div class="input-field">
              <label for="">Bike</label>
              <select name="bike" id="" value=<?php echo $bike;?>>
                <option disabled selected>Is this parking allow bikes?</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Total Bike Slot(if allowed):</label>
              <input type="number" name="bikeslot" id="" class="form-control" placeholder="Enter total bike slot" value=<?php echo $bikeslot;?>>
            </div>

            <div class="input-field">
              <label for="">Car</label>
              <select name="car" id="" value=<?php echo $car;?>>
                <option disabled selected>Is this parking allow car?</option>
                <option>Yes</option>
                <option>No</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Total Car Slot(if allowed):</label>
              <input type="number" name="carslot" id="" class="form-control" placeholder="Enter total car slot" value=<?php echo $carslot;?>>
            </div>

            <div class="input-field">
              <label for="">Parking Opening Time: </label>
              <input type="time" name="opentime" id="" class="form-control" placeholder="Select the parking opening time" value=<?php echo $opentime;?>>
            </div>

            <div class="input-field">
              <label for="">Parking Closing Time: </label>
              <input type="time" name="endtime" id="" class="form-control" placeholder="Select the parking colsing time" value=<?php echo $endtime;?>>
            </div>
            
            <div class="input-field">
              <label for="">Parking Category</label>
              <select name="placecategory" id="" value=<?php echo $placecategory;?>>
                <option disabled selected>Select parking category</option>
                <option>Residential</option>
                <option>Market</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Facility</label>
              <select name="facility" id="" value=<?php echo $facility;?>>
                <option disabled selected>Select facilities</option>
                <option>CCTV</option>
                <option>Guard</option>
                <option>Both(CCTV+Guard)</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Parking Place</label>
              <select name="parkingplace" id="" value=<?php echo $parkingplace;?>>
                <option disabled selected>Select parking place</option>
                <option>Indoor</option>
                <option>Outdoor</option>
                <option>Both(Indoor+Outdoor)</option>
              </select>
            </div>

            <button type="submit" class="submit" name="submit">Submit</button>
          </div>
        </div>
      
    </form>
    </div>

    <!--<script src="script.js"></script>-->
  </body>
</html>
