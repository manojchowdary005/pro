<?php
session_start();

$db = mysqli_connect('localhost','root',"",'tup');
if($db)
{
    echo "connection successful";
}
else{
    echo "no connection";
}
$uname=$_POST['uname'];
$pwd=$_POST['pwd'];
$sql="SELECT * FROM tup WHERE uname='$uname' && pwd='$pwd'";
$result=mysqli_query($db,$sql);
$num=mysqli_num_rows($result);
if($num == 1)
{
    header("location: order.php");
}
else{
    header("location: register.html");
    
}
?>

