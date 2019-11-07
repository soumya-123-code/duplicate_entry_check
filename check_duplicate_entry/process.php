<?php
include('connect.php');
if(isset($_POST['save']))
{
$user_name = $_POST['user_name'];
$email_id = $_POST['email_id'];
$user_password = $_POST['password'];
$duplicate=mysqli_query($conn,"select * from user_login where user_name='$user_name' or email_id='$email_id'");
if (mysqli_num_rows($duplicate)>0)
{
header("Location: index.php?message=User name or Email id already exists.");
}
else{
try {
date_default_timezone_set("Asia/Calcutta");
$insertdate = date("Y-m-d H:i:s");
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO user_login (email_id,user_name,password,date_time)
VALUES ('$email_id', '$user_name','$user_password','$insertdate')";
$conn->exec($sql);
header("Location: index.php?message=Thank you for register. Please login to continue.");
}
   catch(PDOException $e)
    {
          echo $sql . "
          " . $e->getMessage();
    }
$conn = null;
}
}
?>
