<?php
include '../connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `subadmin_list` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
       // echo "Deleted successfully";
     header('location:view_SubAdminList.php');
    }else{
        die(mysqli_error($con));
    }
}

?>