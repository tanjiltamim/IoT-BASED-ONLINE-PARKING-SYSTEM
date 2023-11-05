<?php
include 'connect.php';

class ArduinoData
{
    
 public $link='';

 function __construct($distance1, $distance2)
 {
  $this->storeInDB($distance1, $distance2);
 }
 
 
 function storeInDB($distance1, $distance2)
 {
    include 'connect.php';
    $status1;
    if($distance1>10)
    {
        $status1="Empty";
    }
    else 
    {
        $status1="Occupied";
    }
    $query1 = "UPDATE `slotlist_subid:1` SET `Slot_Status` ='$status1' WHERE `Slot_Id` = 1";
    $result1 = mysqli_query($con,$query1);


    $status2;
    if($distance2>10)
    {
        $status2="Empty";
    }
    else 
    {
        $status2="Occupied";
    }

    $query2 = "UPDATE `slotlist_subid:1` SET `Slot_Status` ='$status2' WHERE `Slot_Id` = 2";
    $result2 = mysqli_query($con,$query2);

    


    //Fetching Slot 1 Data
    $sqlSlot1= "SELECT * FROM `slotlist_subid:1` WHERE Slot_Id=1;";
    $sqlSlot1Result1 = mysqli_query($con, $sqlSlot1);
    $row1 = mysqli_fetch_assoc($sqlSlot1Result1);
    $slotstatus1 = $row1["Slot_Status"];
    $bookingstatus1 = $row1["Booking_Status"];


    if ($slotstatus1=="Occupied" && $bookingstatus1=="Available") 
    {
        $sqlOverTime1="UPDATE `overtime` SET Total_Overtime = Total_Overtime+1 WHERE Sub_Id=1";
        $sqlOverTime1Update1 = mysqli_query($con, $sqlOverTime1);
    }
    //Fetching Slot 2 Data
    $sqlSlot2= "SELECT * FROM `slotlist_subid:1` WHERE Slot_Id=2;";
    $sqlSlot2Result2 = mysqli_query($con, $sqlSlot2);
    $row2 = mysqli_fetch_assoc($sqlSlot2Result2);
    $slotstatus2 = $row2["Slot_Status"];
    $bookingstatus2 = $row2["Booking_Status"];

    if ($slotstatus2=="Occupied" && $bookingstatus2=="Available") 
    {
        $sqlOverTime2="UPDATE `overtime` SET Total_Overtime = Total_Overtime+1 WHERE Sub_Id=1";
        $sqlOverTime2Update2 = mysqli_query($con, $sqlOverTime2);
    }

 }
 
}

if($_GET['distance1'] != '' and  $_GET['distance2'] != '')
{
 $ArduinoData=new ArduinoData($_GET['distance1'],$_GET['distance2']);
}



?>