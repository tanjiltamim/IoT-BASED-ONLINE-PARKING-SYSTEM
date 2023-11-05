<?php

$testName = trim($_POST['name']);
$nameStructure = '/^[A-Za-z ]*$/';
if(preg_match($nameStructure, $testName) && strlen($testName)>0)
{
    $name=$testName;
}
else {
    echo "<script>alert('Please Enter a valid name!') </script>";
    die();
}

$testPhone = trim($_POST['phone']);
$phoneStructure = '/^[0-9]{11,11}$/';
if(preg_match($phoneStructure, $testPhone))
{
    $phone=$testPhone;
}
else {
    echo "<script>alert('Please Enter a valid phone number!') </script>";
    die();
}

$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($name) || !empty($phone) || !empty($email) || !empty($password)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "parko";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if (mysqli_connect_error()) {
        die('Connection Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else{
        $SELECT = "SELECT email From user_list Where email = ? Limit 1";
        $INSERT = "INSERT Into user_list (name,phone,email,password) values(?,?,?,?)";

        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("siss", $name, $phone, $email, $password);
            $stmt->execute();
            //echo "Submitted Successfully!";
            header("location:user_login.php");
        } else{
            echo "<script>alert('Already have an account using this email!') </script>";
        }
        $stmt->close();
        $conn->close();
    }



} else {
    echo "All field are required";
    die();
}

?>