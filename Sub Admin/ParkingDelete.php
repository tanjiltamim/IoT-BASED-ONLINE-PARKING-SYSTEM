<?php
include '../connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $PlaceDelete="delete from `parkingplace` where id=$id";
    $SlotTableDelete="DROP TABLE `slotlist_subid:$id` ";

    $resultPlace=mysqli_query($con,$PlaceDelete);
    $resultSlotTable=mysqli_query($con,$SlotTableDelete);
    
    if($resultPlace && $resultSlotTable){
       // echo "Deleted successfully";
     header('location:view_ParkingInfo.php');
    }else{
        die(mysqli_error($con));
    }
}

?>