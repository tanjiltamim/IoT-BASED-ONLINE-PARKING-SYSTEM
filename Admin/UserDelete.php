<?php
include '../connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `user_list` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
       // echo "Deleted successfully";
     header('location:view_UserList.php');
    }else{
        die(mysqli_error($con));
    }
}

?>