

<?php

$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$address = $_POST['address'];
$email = $_POST['email'];

if (!empty($uname) || !empty($pwd) || !empty($address) || !empty($email))
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "tup";
$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
if(mysqli_connect_error())
{
    die('Connect Error ('. mysqli_connect_errno().')'. mysqli_connect_error());
}


else{
$SELECT ="SELECT email From tup where email = ? Limit 1";
$INSERT = "INSERT Into tup(uname,pwd,address,email)
    values (?,?,?,?)";
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum = $stmt->num_rows;

if($rnum ==0)
{
$stmt->close();
$stmt = $conn->prepare($INSERT);
$stmt->bind_param("ssss",$uname,$pwd,$address,$email);
$stmt->execute();
     echo "new record inserted";
    }
else
{
echo "already someone registered";
}
$stmt->close();
$conn->close();
}
}

else
{
    echo "all fields are required";
    die();
}

?>