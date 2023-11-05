<?php
include '../connect.php';
if(isset($_GET['userid'])){
    $id=$_GET['userid'];

    $sql="SELECT * from `user_list` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];

        if($image == '')
        {
          echo 'No Image Found';
        }
        else
        {
          echo '<img src="../User/uploaded_img/'.$image.'" style="width:500px;">';
        }
        

    }else{
        die(mysqli_error($con));
    }
}

?>