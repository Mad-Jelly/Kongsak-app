<?php
$hostname="localhost";
$username="root";
$password="1234";
$dbname="cp706962_mid_log";
$con=mysqli_connect($hostname,$username,$password);
mysqli_query($con,"SET NAMES UTF8");
mysqli_select_db($con,$dbname);
?>


