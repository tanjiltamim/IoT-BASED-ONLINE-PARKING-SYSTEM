<?php
session_start();
if (!isset($_SESSION['SubAdminLoginEmail'])) {
  header("location:SubAdminLogin.php");
}
include '../connect.php';
?>


<?php
//Getting Subadmin data
//
$SearchText = $_SESSION['SubAdminLoginEmail'];
$sql_search = "SELECT * FROM `subadmin_list` WHERE email='$SearchText'";
$SearchResult = mysqli_query($con, $sql_search);
$row = mysqli_fetch_assoc($SearchResult);
$subadminid = $row['id'];
$subadminname = $row["name"];
$subadminphone = $row["phone"];
$subadminemail = $row["email"];
$subadminpassword = $row["password"];



//Submitting form data

if (isset($_POST['submit'])) {
  $division = $_POST["division"];
  $thana = $_POST["thana"];
  $ward = $_POST["ward"];
  $fulladdress = $_POST["fulladdress"];
  $opentime = $_POST["opentime"];
  $closetime = $_POST["closetime"];
  $parkingcategory = $_POST["parkingcategory"];
  $facility = $_POST["facility"];
  $parkingplace = $_POST["parkingplace"];
  $guardnumber = $_POST["guardnumber"];

  if ($_POST["smallslot"]=="" || $_POST["smallslotprice"]=="") 
  {
    $smallslot = 0;
    $smallslotprice = 0;
  }
  else
  {
    $smallslot = $_POST["smallslot"];
    $smallslotprice = $_POST["smallslotprice"];
  }

  if ($_POST["mediumslot"]=="" || $_POST["mediumslotprice"]=="") 
  {
    $mediumslot = 0;
    $mediumslotprice = 0;
  }
  else
  {
    $mediumslot = $_POST["mediumslot"];
    $mediumslotprice = $_POST["mediumslotprice"];
  }

  if ($_POST["largeslot"]=="" || $_POST["largeslotprice"]=="") 
  {
    $largeslot = 0;
    $largeslotprice = 0;
  }
  else
  {
    $largeslot = $_POST["largeslot"];
    $largeslotprice = $_POST["largeslotprice"];
  }
  //Creating Balance Table
  $tableCreateBalance = "CREATE TABLE `balance_subid:$subadminid` (
                          `Booking_Id` INT(11) NOT NULL ,
                          `Total_Paid` INT(11) NOT NULL ,
                          `Booked_Date` DATETIME NOT NULL ,
                          PRIMARY KEY  (`Booking_Id`))";
  $tableCreateBalanceRun = mysqli_query($con, $tableCreateBalance);

  $sql = "INSERT INTO `total_balance` (sub_id, Total_Transaction)   
    values('$subadminid', '0') ";
  $result = mysqli_query($con, $sql);


  $sql = "INSERT INTO `parkingplace` (id, email, division, thana, ward, fulladdress, opentime, closetime, parkingcategory, facility, parkingplace, guardnumber, smallslot, mediumslot, largeslot)   
    values('$subadminid', '$subadminemail', '$division', '$thana', '$ward', '$fulladdress', '$opentime', '$closetime', '$parkingcategory', '$facility', '$parkingplace', '$guardnumber', '$smallslot', '$mediumslot', '$largeslot' ) ";
  $result = mysqli_query($con, $sql);

  //Creating Slot table
  $tableCreate = "CREATE TABLE `slotlist_subid:$subadminid` (
                          `Slot_Id` INT(11) NOT NULL AUTO_INCREMENT ,
                          `Sub_Admin_Id` INT(11) NOT NULL ,
                          `Slot_Size` VARCHAR(20) NOT NULL ,
                          `PricePerHour` INT(20) NOT NULL ,
                          `Slot_Status` VARCHAR(20) NOT NULL ,
                          `Booking_Status` VARCHAR(20) NOT NULL ,
                          PRIMARY KEY  (`Slot_Id`))";
  $tableCreateRun = mysqli_query($con, $tableCreate);

  //Inserting into Overtime table
  $OverTimeInsert ="INSERT INTO `overtime` (Sub_Id, Total_Overtime)   
    values('$subadminid', '0')  ";
  $OverTimeInsertRun = mysqli_query($con, $OverTimeInsert);


  //Inserting small slot in the slot table
  $smallInsert ="INSERT INTO `slotlist_subid:$subadminid` (Sub_Admin_Id, Slot_Size, PricePerHour, Slot_Status, Booking_Status)   
    values('$subadminid', 'Small','$smallslotprice', 'Not Connected', 'Available')  ";
  while($smallslot != 0) {
    $SmallSlotRun = mysqli_query($con, $smallInsert);
    $smallslot--;
  } 
  //Inserting medium slot in the slot table
  $mediumInsert ="INSERT INTO `slotlist_subid:$subadminid` (Sub_Admin_Id, Slot_Size,  PricePerHour, Slot_Status, Booking_Status)   
    values('$subadminid', 'Medium', '$mediumslotprice', 'Not Connected', 'Available')  ";
  while($mediumslot != 0) {
    $MediumSlotRun = mysqli_query($con, $mediumInsert);
    $mediumslot--;
  } 
  //Inserting large slot in the slot table
  $largeInsert ="INSERT INTO `slotlist_subid:$subadminid` (Sub_Admin_Id, Slot_Size, PricePerHour, Slot_Status, Booking_Status)   
    values('$subadminid', 'Large', '$largeslotprice', 'Not Connected', 'Available')  ";
  while($largeslot != 0) {
    $LargeSlotRun = mysqli_query($con, $largeInsert);
    $largeslot--;
  } 
  
  if ($result && $tableCreateRun) {
    echo "Submited Successfully";
  } else {
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
  <link rel="stylesheet" href="ParkingPlaceForm.css" />

  <!----===== Iconscout CSS ===== -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <title>Registration</title>
</head>

<body>
  <div class="container">
    <nav id="navBar">
      <a href="SubAdmin.php"><img src="../images/logo.png" class="logo" /></a>
    </nav>
    <form method="post">

      <header>Parking Place Registration Form</header>

    
        <div class="form first">
          <div class="fields">

            <div class="input-field">
              <label for="">Division</label>
              <select name="division" id="">
                <option selected>Dhaka</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Thana</label>
              <select name="thana" id="">
                <option disabled selected>Select Thana</option>
                <option>Paltan</option>
                <option>Motijheel</option>
                <option>Sabujbagh</option>
                <option>Khilgaon</option>
                <option>Mugda</option>
                <option>Shahjahanpur</option>
                <option>Shampur</option>
                <option>Jatrabari</option>
                <option>Demra</option>
                <option>Kadamtali</option>
                <option>Gandaria</option>
                <option>Wari</option>
                <option>Ramna</option>
                <option>Shahbag</option>
                <option>Dhanmondi</option>
                <option>Hazaribagh</option>
                <option>Kalabgan</option>
                <option>Kotwali</option>
                <option>Sutrapur</option>
                <option>Lalbagh</option>
                <option>Bangsal</option>
                <option>Chawkbazar</option>
                <option>Kamrangirchar</option>
                <option>Turag</option>
                <option>Uttara West</option>
                <option>Uttara East</option>
                <option>Uttarkhan</option>
                <option>Dakkhinkhan</option>
                <option>Bimanbandar</option>
                <option>Khilkhet</option>
                <option>Vatara</option>
                <option>Badda</option>
                <option>Rampura</option>
                <option>Hatirjheel</option>
                <option>Shilpanchal</option>
                <option>Tejgaon</option>
                <option>Sher-E-Bangla nagar</option>
                <option>Mohammadpur</option>
                <option>Adabor</option>
                <option>Darussalam</option>
                <option>Mirpur</option>
                <option>Pallabi</option>
                <option>Rupnagar</option>
                <option>Shahali</option>
                <option>Kafrul</option>
                <option>Bhashantek</option>
                <option>Cantonment</option>
                <option>Banani</option>
                <option>Gulshan</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Ward No:</label>
              <input type="number" name="ward" id="" value="" class="form-control" placeholder="Enter ward number" required />
            </div>

            <div class="input-field">
              <label for="">Full address:</label>
              <input type="string" name="fulladdress" id="" class="form-control" placeholder="Enter full address" required />
            </div>
            <div class="input-field">
              <label for="">Parking Opening Time: </label>
              <input type="time" name="opentime" value="07:00" id="" class="form-control" placeholder="Select the parking opening time" required />
            </div>

            <div class="input-field">
              <label for="">Parking Closing Time: </label>
              <input type="time" name="closetime" value="23:59" id="" class="form-control" placeholder="Select the parking colsing time" required />
            </div>

            <div class="input-field">
              <label for="">Parking Category</label>
              <select name="parkingcategory" id="" required>
                <option disabled selected>Select parking category</option>
                <option>Residential</option>
                <option>Market</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Facility</label>
              <select name="facility" id="" required>
                <option disabled selected>Select facilities</option>
                <option>CCTV</option>
                <option>Guard</option>
                <option>CCTV+Guard</option>
                <option>No Facility</option>
              </select>
            </div>

            <div class="input-field">
              <label for="">Parking Place</label>
              <select name="parkingplace" id="" required>
                <option disabled selected>Select parking place</option>
                <option>Indoor</option>
                <option>Outdoor</option>
                <option>Both(Indoor+Outdoor)</option>
              </select>
            </div>
            <div class="input-field">
              <label for="">Security Guard Number:</label>
              <input type="number" name="guardnumber" id="" value="" class="form-control" placeholder="Enter security guard number" required/>
            </div>
            
          </div>
          <header>Please Enter The Parking Slot Size and Price</header>

          <div class="fields">
              <div class="input-field">
                <label for="">Small(For small size vehicle like "Bikes"):</label>
                <input type="number" name="smallslot" value="" id="" class="form-control" placeholder="Enter total small size slot"/>
              </div>
              <div class="input-field">
                <label for="">Small Slot Price Per Hour:</label>
                <input type="number" name="smallslotprice" value="" id="" class="form-control" placeholder="Enter small slot price"/>
              </div>
              <div class="input-field">
                <label for="">Medium(For medium size vehicle like "Car"):</label>
                <input type="number" name="mediumslot" value="" id="" class="form-control" placeholder="Enter total medium size slot"/>
              </div>
              <div class="input-field">
                <label for="">Medium Slot Price Per Hour:</label>
                <input type="number" name="mediumslotprice" value="" id="" class="form-control" placeholder="Enter medium slot price"/>
              </div>
              <div class="input-field">
                <label for="">Large(For large size vehicle like "Microbus"):</label>
                <input type="number" name="largeslot" value="" id="" class="form-control" placeholder="Enter total large size slot"/>
              </div>
              <div class="input-field">
                <label for="">Large Slot Price Per Hour:</label>
                <input type="number" name="largeslotprice" value="" id="" class="form-control" placeholder="Enter large slot price"/>
              </div>

          </div>

          <button type="submit" class="submit" name="submit">Submit</button>

        </div>
        
        

    </form>
  </div>

  <!--<script src="script.js"></script>-->
</body>

</html>