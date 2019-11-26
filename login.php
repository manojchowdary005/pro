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
    header("location: signin.php");
    
}
?>
<html>
    <head>
        <link rel="stylesheet" href="style1.css">
        
    </head>

    <body>
        <div class="login-page">
            <div class="form">
              

                <form method="post" name="login" class="login-form">
                   <input type="text" placeholder="username" name="uname" required>
                    <input type="password" placeholder="password" name="pwd" required>
                    <button class="b" value="submit" type="submit" onsubmit="order.php">login</button>
                    <p class="message">Not Registered? <a href="register.html">Register</a></p><br>
                    <p class="me"><a href="index.html">Home</a></p>
                    </form>
            </div>
        </div>
       
    </body>
    </html>
