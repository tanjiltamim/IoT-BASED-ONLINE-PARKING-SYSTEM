<?php
  session_start();
  if(!isset($_SESSION['UserLoginEmail']))
  {
    header("location:user_login.php");
  }
  include '../connect.php';
  $SearchText = $_SESSION['UserLoginEmail'];
  $sql_search = "SELECT * FROM `user_list` WHERE email='$SearchText'";
  $SearchResult = mysqli_query($con, $sql_search);
  $row = mysqli_fetch_assoc($SearchResult);
  $id = $row['id'];
  $name = $row["name"];
  $phone = $row["phone"];
  $email = $row["email"];
  $password = $row["password"];
  $vehicleNo= $row["vehicleNo"];
  $image = $row['image'];
?>
<?php

if(isset($_POST['submit']))
{

    $newname = $_POST['new-name'];
    $newphone = $_POST['new-phone'];
    $newemail = $_POST['new-email'];
    $oldpass = $_POST['old-pass'];
    $newpass = $_POST['new-pass'];
    $newvehicleNo = $_POST['vehicleNo'];
    $newimage = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$newimage;

    if ($newvehicleNo != '') 
    {
        $vehicleNo = $newvehicleNo;
    }

    $updatename= mysqli_query($con, "UPDATE `user_list` SET name = '$newname' WHERE id = '$id'") or die('query failed');
    $updatephone= mysqli_query($con, "UPDATE `user_list` SET email = '$newemail' WHERE id = '$id'") or die('query failed');
    $updateemail= mysqli_query($con, "UPDATE `user_list` SET phone = '$newphone' WHERE id = '$id'") or die('query failed');
    $updatvehicle= mysqli_query($con, "UPDATE `user_list` SET vehicleNo = '$newvehicleNo' WHERE id = '$id'") or die('query failed');
    if ($oldpass=='' || $newpass=='')
    {
        //echo "<script>alert('Empty Password!') </script>";
    }
    elseif($oldpass != $password)
    {
        echo "<script>alert('Old password is not correct!') </script>";
    }
    elseif($oldpass == $newpass)
    {
        echo "<script>alert('Your new password cannot be your old password!') </script>";
    }
    else
    {  
        $updatepass= mysqli_query($con, "UPDATE `user_list` SET password = '$newpass' WHERE id = '$id'") or die('query failed');
          
        //echo "<script>alert('Updated Successfully') </script>";
        header('location:user_profile.php');
    }

    if($image_size > 5000000)
    {
        echo "<script>alert('Image size is too large!') </script>";
    }
    elseif ($newimage=='') 
    {
        //echo "<script>alert('No image seleted') </script>";
        //header('location:user_profile.php');
    }
    else
    {
        $UpdateImage = mysqli_query($con, "UPDATE `user_list` SET image = '$newimage' WHERE id ='$id' ") or die('query failed');

        move_uploaded_file($image_tmp_name, $image_folder);
        echo "<script>alert('Image Updated successfully!') </script>";
        header('location:user_profile.php');
    }       
        
    //header('location:user_profile.php');
 
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="user_profile.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <title>Your Profile</title>
  
</head>


<body>
  <div class="main-content">
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../images/background.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <div>
              <a href="user.php"><img src="../images/logo.png" class="logo" /></a>
            </div>
            <br>
            <br>
            <h1 class="display-2 text-white">Hello, <?php echo "$name" ; ?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see your profile info and also update them.</p>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <?php 
                        if($image == '')
                        {
                          echo '<img src="../images/blank-profile.jpg" class="rounded-circle">';
                        }
                        else
                        {
                          echo '<img src="uploaded_img/'.$image.'" class="rounded-circle">';
                        } 
                    ?>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <br>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                    <?php echo "$name" ; ?>
                </h3>
                <div>
                  <i class="ni education_hat mr-2"></i>Email: <?php echo "$email" ; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Phone: <?php echo "0$phone" ; ?>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="user_profile.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">Name</label>
                        <input type="text" id="input-username" name="new-name" class="form-control form-control-alternative" placeholder="Full Name" value="<?php echo "$name" ; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Email Address</label>
                        <input type="email" id="input-email" name="new-email" class="form-control form-control-alternative" placeholder="Email" value="<?php echo "$email" ; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">Phone</label>
                        <input type="text" id="input-first-name" name="new-phone" class="form-control form-control-alternative" placeholder="Phone Number" value="<?php echo "0$phone" ; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label">Vehicle Number</label>
                        <input type="text" id="input-first-name" name="vehicleNo" class="form-control form-control-alternative" placeholder="Enter Vehicle Number" value="<?php echo "$vehicleNo" ; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Photo</label>
                        <input type="file" name="image" id="input-first-name" class="form-control form-control-alternative" accept="image/jpg, image/jpeg, image/png, image/gif" value="">
                      </div>
                    </div>
                  </div>
                </div>

                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Password</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Old Password</label>
                        <input class="form-control form-control-alternative" placeholder="Enter your old password" type="password" name="old-pass"  value="">
                      </div>
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">New Password</label>
                        <input class="form-control form-control-alternative" placeholder="Enter new password" value="" type="password" name="new-pass">
                      </div> 
                    </div>
                  </div>
                </div>
                <input type="submit" name="submit" value="Update" class="btn btn-info">
        
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
  if (isset($_POST['logout'])) 
  {
    session_destroy();
    header("location:user_login.php");
  }

?>