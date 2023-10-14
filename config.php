<?php 
$conn_str=mysqli_connect('localhost','root','','reminder_system');
if($conn_str==true){
    echo"connected";
}
else{
    echo"connection failed";
}
?>