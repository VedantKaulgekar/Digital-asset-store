<?php
$server = "localhost";
$username = "root";
$password = "";
$database2 = "uploads";

$conn2 = mysqli_connect($server,$username,$password,$database2);

if (!$conn2){
    die("An Error occured ". mysqli_connect_error());
}

?>