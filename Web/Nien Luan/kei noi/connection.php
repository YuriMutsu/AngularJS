
<?php
$username = "admin";
$password = "admin";
$server_host = "localhost";
$database ="nienluan";
 
$conn = mysqli_connect($server_host,$username,$password,$database) or die("không thể kết nối tới database");

mysqli_query($conn,"SET NAMES 'UTF8'");

?>